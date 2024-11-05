<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AlumniController extends AbstractController
{
    #[Route('/alumni', name: 'app_alumni')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render('alumni/index.html.twig', [
            'controller_name' => 'AlumniController',
        ]);
    }
}
