<?php

namespace App\Controller;

use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;



class ListeReservationsController extends AbstractController
{
    #[Route('/liste/reservations', name: 'app_liste_reservations')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Récupérer toutes les réservations de l'utilisateur
        $reservations = $entityManager->getRepository(Reservation::class)->findBy(['id_user' => $user]);

        return $this->render('liste_reservations/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }
}