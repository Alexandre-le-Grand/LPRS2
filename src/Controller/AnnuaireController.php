<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;

class AnnuaireController extends AbstractController
{
    #[Route('/annuaire', name: 'app_annuaire')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render('annuaire/index.html.twig', [
            'users' => $users,
        ]);
    }
}

