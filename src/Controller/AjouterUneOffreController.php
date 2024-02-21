<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Form\AjoutDispoType;
use App\Form\AjouterUneOffreFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjouterUneOffreController extends AbstractController
{
    #[Route('/ajouteruneoffre', name: 'app_ajouter_une_offre')]
    public function index(Request $request): Response
    {
        $offre = new Offre();
        $form = $this->createForm(AjouterUneOffreFormType::class, null);

        $form->handleRequest($request);

        $dispo = $this->createForm(AjoutDispoType::class, null);
        $dispo->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Traitez les données du formulaire ici, par exemple :
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($offre);
            // $entityManager->flush();

            return $this->redirectToRoute('page_de_confirmation');
        }
        if ($dispo->isSubmitted() && $dispo->isValid()) {
            // Traitez les données du formulaire ici, par exemple :
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($offre);
            // $entityManager->flush();
            return $this->redirectToRoute('app_ajouter_une_offre');
        }
        return $this->render('ajouter_une_offre/index.html.twig', [
            'controller_name' => 'AjouterUneOffreController',
            'offreForm' => $form->createView(),
            'dispoForm' => $dispo->createView(),
        ]);
    }
}