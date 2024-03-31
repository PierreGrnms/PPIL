<?php

namespace App\Controller;

use App\Entity\Disponibilites;
use App\Entity\Offre;
use App\Entity\Photo;
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
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $request->query->get('id');

        if ($id) {
            $dispos = $entityManager->getRepository(Disponibilites::class)->findBy(['id_offre' => $id]);
            $photos = $entityManager->getRepository(Photo::class)->findBy(['id_offre' => $id]);

            return $this->render('liste_offre/index.html.twig', [
                'controller_name' => 'ListeOffreController',
                'offre' => $entityManager->getRepository(Offre::class)->find($id),
                'offres' => null,
                'dispos' => $dispos,
                'photos' => $photos,
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
        $user = $this->getUser();
        if ($user) {
            if ($id) {
                return $this->render('liste_offre/index.html.twig', [
                    'controller_name' => 'ListeOffreController',
                    'offre' => $entityManager->getRepository(Offre::class)->find($id),
                    'offres' => null,
                    'mine' => true,
                    'photos' => $photos,
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
}
