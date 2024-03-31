<?php

namespace App\Controller;

use App\Entity\Disponibilites;
use App\Entity\Offre;
use App\Entity\Reservation;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeOffreController extends AbstractController
{
    #[Route('/offres', name: 'app_liste_offre')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        return $this->render('liste_offre/index.html.twig', [
            'controller_name' => 'ListeOffreController',
            'offres' => $entityManager->getRepository(Offre::class)->findAll(),
        ]);
    }


}
