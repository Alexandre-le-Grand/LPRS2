<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EventFormType;
use Doctrine\ORM\EntityManagerInterface; // Importez cette classe
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/event', name: 'app_event')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response // Injection du EntityManager
    {
        $evenement = new Evenement(); // Créez une nouvelle instance de l'événement
        $form = $this->createForm(EventFormType::class, $evenement); // Créez le formulaire

        $form->handleRequest($request); // Gérer la requête

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrer l'événement dans la base de données
            $entityManager->persist($evenement);
            $entityManager->flush();

            // Rediriger vers une page de succès ou l'index
            return $this->redirectToRoute('app_event_success');
        }

        // Rendre la vue avec le formulaire
        return $this->render('event/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/event/success', name: 'app_event_success')]
    public function success(): Response
    {
        return $this->render('event/success.html.twig');
    }
}