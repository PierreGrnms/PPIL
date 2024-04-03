<?php

namespace App\Controller;

use App\Entity\Disponibilites;
use App\Entity\Offre;
use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesOffreController extends AbstractController
{
    #[Route('/mes-offres', name: 'app_mes_offres')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if ($user) {
            return $this->render('mes_offres/index.html.twig', [
                'controller_name' => 'MesOffreController',
                'offres' => $entityManager->getRepository(Offre::class)->findBy(["id_user" => $user])
            ]);
        }
        return $this->redirectToRoute('app_login');

    }
}
