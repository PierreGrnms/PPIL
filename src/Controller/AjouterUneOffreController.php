<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Form\AjoutDispoType;
use App\Form\AjouterUneOffreFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
class AjouterUneOffreController extends AbstractController
{
    #[Route('/ajouteruneoffre', name: 'app_ajouter_une_offre')]
    public function index(Request $request): Response
    {
        $offre = new Offre();
        echo('test') ;

        return $this->render('ajouter_une_offre/index.html.twig', [
            'controller_name' => 'AjouterUneOffreController',
        ]);
    }
    /**
     * @Route("/ajouteruneoffre", name="app_ajouter_une_offre")
     */
    public function votreAction(Request $request)  
    {
        
        // Récupérer les données envoyées via la requête AJAX
        $data = json_decode($request->getContent(), true);

        // Traiter les données
        $titre = $data['titre'];
        $description = $data['description'];
        $prix = $data['prix'];
        $listeDispo = $data['listeDispo'];
        $listeFichier = $data['listeFichier'];
        echo $data ;
        // Faites ce que vous devez faire avec les données, par exemple :
        // Enregistrer les données dans la base de données
        // ...

        // Répondre à la requête AJAX
        return new JsonResponse(['message' => 'Données reçues avec succès !']);
    }
}