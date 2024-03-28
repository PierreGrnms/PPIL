<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Offre;
use App\Entity\Disponibilites;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Reservation;
use Symfony\Component\Validator\Constraints\DateTime;
use DateTimeImmutable;
class ReserverOffreController extends AbstractController
{
    #[Route('reserver/offre', name: 'app_reserver_offre')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $id = $request->query->get('id');

        if ($id) {
            return $this->render('reserver_offre/index.html.twig', [
                'controller_name' => 'ReserverOffreController',
                'offre' => $entityManager->getRepository(Offre::class)->find($id),
                'creneaux' => $entityManager->getRepository(Disponibilites::class)->findBy(['id_offre' => $id]),
            ]);

        } else {
            return $this->render('liste_offre/index.html.twig', [
                'controller_name' => 'ReserverOffreController',
                'offres' => $entityManager->getRepository(Offre::class)->findAll(),
            ]);
        }
    }
    #[Route('reserver_offre', name: 'app_reserver_offre_action')]
    public function reserverOffre(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $id = $request->query->get('id');
        $creneau = $request->get('creneau');
        
        // Extraire les parties de la chaîne pour obtenir les dates de début et de fin
        $creneauParts = explode(' - ', $creneau);
        $debutStr = $creneauParts[0];
        $finStr = $creneauParts[1];

        // Convertir les chaînes de date en objets DateTimeImmutable
        $debut = DateTimeImmutable::createFromFormat('d/m/Y H:i', $debutStr);
        $fin = DateTimeImmutable::createFromFormat('d/m/Y H:i', $finStr);

        // Recherchez l'offre et la disponibilité
        $offre = $entityManager->getRepository(Offre::class)->find($id);
        $dispo = $entityManager->getRepository(Disponibilites::class)->findOneBy([
            'id_offre' => $id,
            'debut' => $debut,
            'fin' => $fin
        ]);

        // Vérifiez si l'offre et la disponibilité existent
        if ($offre && $dispo && $user) {
            // Vérifiez si l'utilisateur a assez d'argent
            if ($user->getPorteMonnaie() >= $offre->getPrix()) {
                // Soustrayez le coût de l'offre du porte-monnaie de l'utilisateur
                $user->setPorteMonnaie($user->getPorteMonnaie() - $offre->getPrix());

                // Supprimez la disponibilité
                $offre->removeDisponibilite($dispo);
                $entityManager->remove($dispo);

                // Créez et persistez la réservation
                $reservation = new Reservation();
                $reservation->setReservDebut($debut);
                $reservation->setReservFin($fin);
                $reservation->setIdUser($user);
                $reservation->setIdOffre($offre);
                $entityManager->persist($reservation);

                // Flush les modifications à la base de données
                $entityManager->flush();

                // Ajoutez un message de confirmation
                $this->addFlash('success', 'La réservation a été effectuée avec succès.');
                // Redirigez l'utilisateur vers la page d'accueil
                return $this->redirectToRoute('home');
            } else {
                // Popup pas assez d'argent
                return $this->render('erreur/index.html.twig', [
                    'controller_name' => 'ReserverOffreController',
                    'message' => $message = 'Vous n\'avez pas assez d\'argent pour effectuer cette réservation.',
                ]);
            }
        } else {
            // Popup erreur : offre ou disponibilité introuvable
            return $this->render('erreur/index.html.twig', [
                'controller_name' => 'ReserverOffreController',
                'message' => $message = 'L\'offre ou la disponibilité n\'a pas été trouvée.',
            ]);
        }


    }

}