<?php

namespace App\Controller;

use App\Entity\Disponibilites;
use App\Entity\Evaluation;
use App\Entity\Offre;
use App\Entity\Photo;
use App\Entity\Reservation;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

class ListeOffreController extends AbstractController
{
    #[Route('/offres', name: 'app_liste_offre')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $request->query->get('id');

        if ($id) {
            $dispos = $entityManager->getRepository(Disponibilites::class)->findBy(['id_offre' => $id]);
            $photos = $entityManager->getRepository(Photo::class)->findBy(['id_offre' => $id]);
            $evaluations = $entityManager->getRepository(Evaluation::class)->findBy(['id_offre' => $id]);

            return $this->render('liste_offre/index.html.twig', [
                'controller_name' => 'ListeOffreController',
                'offre' => $entityManager->getRepository(Offre::class)->find($id),
                'offres' => null,
                'dispos' => $dispos,
                'photos' => $photos,
                'evaluations' => $evaluations
            ]);

        }
        else {
            return $this->render('liste_offre/index.html.twig', [
                'controller_name' => 'ListeOffreController',
                'offres' => $entityManager->getRepository(Offre::class)->findAll(),
            ]);
        }
    }

    #[Route('/mes-offres', name: 'app_mes_offres')]
    public function show(Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $request->query->get('id');
        $photos = $entityManager->getRepository(Photo::class)->findBy(['id_offre' => $id]);
        $evaluations = $entityManager->getRepository(Evaluation::class)->findBy(['id_offre' => $id]);

        $user = $this->getUser();
        if ($user) {
            if ($id) {
                return $this->render('liste_offre/index.html.twig', [
                    'controller_name' => 'ListeOffreController',
                    'offre' => $entityManager->getRepository(Offre::class)->find($id),
                    'offres' => null,
                    'mine' => true,
                    'photos' => $photos,
                    'evaluations' => $evaluations

                ]);

            }
            else {
     
                return $this->render('liste_offre/index.html.twig', [
                    'controller_name' => 'ListeOffreController',
                    'offres' => $entityManager->getRepository(Offre::class)->findBy(["id_user" => $user->getid()])
                ]);
            }

        }
    }

    #[Route('/offres/supprimer', name: 'supprimer_offre')]
    public function delete(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'id de l'offre à supprimer
        $id = $request->query->get('id');
        // Récupérer l'offre
        $offre = $entityManager->getRepository(Offre::class)->find($id);
        // supprimer les Disponibilites reliées à l'offre
        $dispos = $entityManager->getRepository(Disponibilites::class)->findBy(['id_offre' => $id]);
        foreach ($dispos as $dispo) {
            $entityManager->remove($dispo);
        }
        //supprimer les reservations reliées à l'offre
        $reservations = $entityManager->getRepository(Reservation::class)->findBy(['id_offre' => $id]);
        foreach ($reservations as $reservation) {
            $entityManager->remove($reservation);
        }
        // Supprimer l'offre
        $entityManager->remove($offre);
        $entityManager->flush();
        return $this->redirectToRoute('app_mes_offres');
    }
    
    #[Route('/offres/evaluation', name: 'evaluation_offre')]
    public function evaluer(Request $request,EntityManagerInterface $entityManager): Response
    {
        // Récupérer les données POST envoyées dans la requête
        $data = json_decode($request->getContent(), true);
        // Traiter les données
        $titre = $data['titre'];
        $description = $data['description'];
        $note = $data['note']; 
        $offreId = $data['id']; 
        $offre = $entityManager->getRepository(Offre::class)->find($offreId) ;
        $eval = new Evaluation()     ;
        $eval->setTitre($titre) ;
        $eval->setNote($note) ;
        $eval->setIdOffre($offre) ;
        if($description != ""){
            $eval->setCommentaire($description) ;
        } 
        $entityManager->persist($eval);
        $entityManager->flush();
        return new Response(' Bonjour Données reçues avec succès !' . $note . $description . $titre );

    }
}
