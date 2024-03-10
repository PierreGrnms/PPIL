<?php

namespace App\Controller;

use App\Entity\Disponibilites;
use App\Entity\Offre;
use App\Form\AjoutDispoType;
use App\Form\AjouterUneOffreFormType;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

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
    #[Route('/ajax', name: 'app_ajax_get', methods: ['POST'])]
    public function ajaxreq(Request $request,EntityManagerInterface $entityManager): Response
    {
        // Récupérer les données envoyées via la requête AJAX
        $data = json_decode($request->getContent(), true);

        // Traiter les données
        $titre = $data['titre'];
        $description = $data['description'];
        $prix = $data['prix'];
        $lstDispo = $data['lstDispo'];
        $lstFichiers = $data['lstFichiers'];
        $mess = "" ;
        foreach ($lstDispo as $key => $value) {
            foreach ($value as $key => $value2) {
                $mess = $mess . $value2 ;
            }
        }
        
        // Faire quelque chose avec les données reçues, par exemple enregistrer dans la base de données
        $offre = new Offre();
        $offre->setTitreOffre($titre);
        $offre->setPrix(floatval($prix));
        $offre->setTexteOffre($description);
        foreach ($lstDispo as $key => $value) {
            $string_date = $value[0] . " " . $value[1] ;
            $dateD = DateTime::createFromFormat('Y-m-d H:i', $string_date);
            $string_date = $value[0] . " " . $value[2] ;
            $dateF = DateTime::createFromFormat('Y-m-d H:i', $string_date);
            $dispo = new Disponibilites() ;
            $dispo->setDebut($dateD) ;
            $dispo->setFin($dateF) ;
            $offre->addDisponibilite($dispo) ;
            $entityManager->persist($offre);
            $entityManager->persist($dispo);
            $entityManager->flush();
            $number_img = 0 ;
            $public_directory = $this->getParameter('kernel.project_dir') . '/public' . '/' . $titre . '/';
            // Chemin du fichier dans le répertoire public
            mkdir($public_directory) ;
            foreach ($lstFichiers as $key => $image_string) {
                $image_string = str_replace('data:image/jpeg;base64,', '', $image_string);
                $image_string = str_replace('data:image/jpg;base64,', '', $image_string);
                $image_string = str_replace('data:image/png;base64,', '', $image_string);

                $imageData = base64_decode($image_string);

                $chemin_fichier = $public_directory . (string)$number_img . '.png';
                file_put_contents($chemin_fichier, $imageData);
                $number_img++ ;
            }

        }
        

        
        // Répondre à la requête AJAX (optionnel)
        return new Response(' Bonjour Données reçues avec succès !' . $mess );
    }
}