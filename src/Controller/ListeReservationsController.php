<?php

namespace App\Controller;

use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Offre;



class ListeReservationsController extends AbstractController
{
    #[Route('/liste/reservations', name: 'app_liste_reservations')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Récupérer toutes les réservations de l'utilisateur
        $reservations = $entityManager->getRepository(Reservation::class)->findBy(['id_user' => $user]);

        
            // Créer un tableau pour stocker les détails de chaque réservation (réservation + offre)
            $reservationsDetails = [];
    
            // Pour chaque réservation, obtenir l'offre associée
            foreach ($reservations as $reservation) {
                $offre = $entityManager->getRepository(Offre::class)->find($reservation->getIdOffre());
                
                // Ajouter les détails de la réservation et de l'offre au tableau
                $reservationsDetails[] = [
                    'reservation' => $reservation,
                    'offre' => $offre,
                ];
            }
    
            return $this->render('liste_reservations/index.html.twig', [
                'reservationsDetails' => $reservationsDetails,
            ]);
    }

    #[Route('/liste/reservations/annulation{id}', name: 'app_annuler_reservation')]
    public function annulerReservation(EntityManagerInterface $entityManager, $id): Response
    {
        // Récupérer la réservation à annuler
        $reservation = $entityManager->getRepository(Reservation::class)->find($id);

        // rembourser le client
        $offre = $entityManager->getRepository(Offre::class)->find($reservation->getIdOffre());
        $user = $this->getUser();
        $user->setPorteMonnaie($user->getPorteMonnaie() + $offre->getPrix());
        $entityManager->persist($user);

        // Supprimer la réservation
        $entityManager->remove($reservation);
        $entityManager->flush();

        // Rediriger l'utilisateur vers la liste des réservations
        return $this->redirectToRoute('app_liste_reservations');
    }
}