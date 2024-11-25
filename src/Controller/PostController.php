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

        // Créez le formulaire
        $form = $this->createForm(PostType::class, $post);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $post->setRefUtilisateur($this->getUser());
            $post->setDateHeurePublication(new \DateTime()); // Date actuelle


            $entityManager->persist($post);
            $entityManager->flush();

            // Redirigez vers la même page après soumission
            return $this->redirectToRoute('app_post_index');
        }

        // Rendre la vue avec le formulaire et les posts existants
        return $this->render('post/index.html.twig', [
            'form' => $form->createView(),
            'posts' => $postRepository->findAll(),
        ]);
    }
}
