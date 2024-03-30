<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilIndexController extends AbstractController
{
    #[Route('/profil/index', name: 'app_profil_index')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $user = $this->getUser();

        return $this->render('profil_index/index.html.twig', [
            'controller_name' => 'ProfilIndexController',
            'user' => $user,
        ]);
    }
}
