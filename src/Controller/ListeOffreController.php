<?php

namespace App\Controller;

use App\Entity\Disponibilites;
use App\Entity\Offre;
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
       /* $offre = new Offre();
        $offre->setTitreOffre("hey");
        $offre->setPrix(floatval(50));
        $offre->setTexteOffre("hey");
        $this->getUser()->addOffres($offre);*/
        //print_r($entityManager->getRepository(Offre::class)->find(1)->getIdUser()->getEmail());

        //print_r($entityManager->getRepository(Disponibilites::class)->findOneBy(['id_offre' => 33]));
        if ($id) {
            return $this->render('liste_offre/index.html.twig', [
                'controller_name' => 'ListeOffreController',
                'offre' => $entityManager->getRepository(Offre::class)->find($id),
                'offres' => null,
            ]);

        }
        else {
            print_r(count($entityManager->getRepository(Offre::class)->findAll()));

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
     
        $user = $this->getUser();
        if ($user) {
            if ($id) {
                return $this->render('liste_offre/index.html.twig', [
                    'controller_name' => 'ListeOffreController',
                    'offre' => $entityManager->getRepository(Offre::class)->find($id),
                    'offres' => null,
                ]);

            }
            else {
     
                return $this->render('liste_offre/index.html.twig', [
                    'controller_name' => 'ListeOffreController',
                    'offres' => $entityManager->getRepository(Offre::class)->findBy(["id_user" => $user->getId()])
                ]);
            }

        }
    }

    /*#[Route('/offres/{offre}', name: 'offre_page')]
    public function show(EntityManagerInterface $entityManager, string $offre): Response
    {
        echo $offre;
        //$offre = $entityManager->getRepository(Offre::class)->find($offre);
        return $this->render('liste_offre/index.html.twig', [
            'controller_name' => 'ListeOffreController',
            'offre' => $offre,
        ]);
    }
    #[Route('/offres/{offre_id}', name: 'offre_page', requirements: ['offre_id' => 'hello'])]
    public function list(string $offre_id): Response
    {
        echo $offre_id;
        echo "test";
        $test = $this->generateUrl('app_liste_offre', [
            'offre_id' => $offre_id,
        ]);
        return $this->render('liste_offre/index.html.twig', [
            'controller_name' => 'ListeOffreController',
        ]);
    }*/
}
