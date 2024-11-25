<?php

namespace App\Controller;

use App\Entity\Reponse;
use App\Form\ReponseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reponse')]
final class ReponseController extends AbstractController
{
    #[Route('/new', name: 'app_reponse_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $reponse = new Reponse();
        $reponse->setContenu($data['contenu']);
        $reponse->setDateHeureReponse(new \DateTime());
        $post = $entityManager->getRepository(Post::class)->find($data['postId']);
        $reponse->setRefPost($post);

        $entityManager->persist($reponse);
        $entityManager->flush();

        return $this->json(['message' => 'Réponse ajoutée avec succès!']);
    }
}
