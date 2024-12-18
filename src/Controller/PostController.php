<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reponse;


#[Route('/post')]
final class PostController extends AbstractController
{
    #[Route('/', name: 'app_post_index', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager, PostRepository $postRepository): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setRefUtilisateur($this->getUser());
            $post->setDateHeurePublication(new \DateTime());
    
            $entityManager->persist($post);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_post_index');
        }
    
        return $this->render('post/index.html.twig', [
            'form' => $form->createView(),
            'posts' => $postRepository->findAllByMostRecent(),
        ]);
    }

    #[Route('/edit/{id}', name: 'app_post_edit', methods: ['GET', 'POST'])]
    public function edit(Post $post, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class, $post);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_post_index');
        }
    
        return $this->render('post/edit.html.twig', [
            'form' => $form->createView(),
            'post' => $post,
        ]);
    }

    #[Route('/post/{id}', name: 'app_post_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Post $post, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour ajouter une réponse.');
        }
    
        $reponses = $post->getReponses();
    
        $contenu = trim($request->request->get('contenu'));
        if (!empty($contenu)) {
            $reponse = new Reponse();
            $reponse->setContenu($contenu);
            $reponse->setDateHeureReponse(new \DateTime());
            $reponse->setRefPost($post);
            $reponse->setRefUtilisateur($user); 
    
            $entityManager->persist($reponse);
            $entityManager->flush();
    
            $this->addFlash('success', 'Réponse ajoutée avec succès.');
            return $this->redirectToRoute('app_post_show', ['id' => $post->getId()]);
        }
    
        return $this->render('post/show.html.twig', [
            'post' => $post,
            'reponses' => $reponses,
        ]);
    }
    
        


    #[Route('/delete/{id}', name: 'app_post_delete', methods: ['POST'])]
    public function delete(Post $post, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $post->getId(), $request->request->get('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_post_index');
    }

    #[Route('/mes_posts', name: 'user.posts', methods: ['GET'])]
    public function userPosts(PostRepository $postRepository): Response
    {
        $user = $this->getUser();
        $posts = $postRepository->findBy(['ref_utilisateur' => $user]);

        return $this->render('post/user_posts.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/post/{id}/reponses', name: 'app_post_reponses', methods: ['POST'])]
    public function addReponse(Request $request, PostRepository $postRepository, EntityManagerInterface $entityManager, int $id): Response
    {
        $post = $postRepository->find($id);
        
        if (!$post) {
            throw $this->createNotFoundException('Post not found');
        }

        $contenu = trim($request->request->get('contenu'));
        
        // Validation pour éviter les mots interdits
        if (empty($contenu)) {
            $this->addFlash('error', 'Le contenu de la réponse ne peut pas être vide.');
            return $this->redirectToRoute('app_post_index');
        }
        
        $badWords = ['insulte1', 'insulte2']; // Liste des mots à bannir
        foreach ($badWords as $badWord) {
            if (stripos($contenu, $badWord) !== false) {
                $this->addFlash('error', 'Votre réponse contient un mot interdit.');
                return $this->redirectToRoute('app_post_index');
            }
        }

        $reponse = new Reponse();
        $reponse->setContenu($contenu);
        $reponse->setDateHeureReponse(new \DateTime());
        $reponse->setRefPost($post);
        $reponse->setRefUtilisateur($this->getUser());

        $entityManager->persist($reponse);
        $entityManager->flush();

        $this->addFlash('success', 'Réponse ajoutée avec succès.');
        return $this->redirectToRoute('app_post_index');
    }

    #[Route('/post/{postId}/reponse/{id}', name: 'app_reponse_edit', methods: ['GET', 'POST'])]
    public function editReponse(Request $request, EntityManagerInterface $entityManager, Reponse $reponse): Response
    {
        $form = $this->createForm(Reponse::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_post_index');
        }

        return $this->render('post/edit_reponse.html.twig', [
            'form' => $form->createView(),
            'reponse' => $reponse,
        ]);
    }

    #[Route('/post/{postId}/reponse/{id}/delete', name: 'app_reponse_delete', methods: ['POST'])]
    public function deleteReponse(Request $request, EntityManagerInterface $entityManager, Reponse $reponse): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reponse->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reponse);
            $entityManager->flush();

            $this->addFlash('success', 'Réponse supprimée avec succès.');
        }

        return $this->redirectToRoute('app_post_index');
    }
}