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
}
