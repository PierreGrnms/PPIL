<?php

namespace App\Controller;

use App\Entity\Disponibilites;
use App\Entity\Evaluation;
use App\Entity\Message;
use App\Entity\Offre;
use App\Entity\Photo;
use App\Entity\Reservation;
use App\Form\AjouterUneOffreFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OffreController extends AbstractController
{
    #[Route('/offre', name: 'app_offre')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $request->query->get('id');
        if ($id) {
            return $this->render('offre/index.html.twig', [
                'controller_name' => 'OffreController',
                'offre' => $entityManager->getRepository(Offre::class)->find($id),
                'dispos' => $entityManager->getRepository(Disponibilites::class)->findBy(['id_offre' => $id]),
                'photos' => $entityManager->getRepository(Photo::class)->findBy(['id_offre' => $id]),
                'evaluations' => $entityManager->getRepository(Evaluation::class)->findBy(['id_offre' => $id]),
            ]);
        }
        else {
            return $this->render('offre/index.html.twig', [
                'controller_name' => 'OffreController',
                'offre' => null,
            ]);
        }
    }

    #[Route('/mon-offre', name: 'app_modif_offre')]
    public function show(Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $request->query->get('id');
        $offre = $entityManager->getRepository(Offre::class)->find($id);
        $form = $this->createForm(AjouterUneOffreFormType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offre->setTitreOffre($form->get("titre_offre")->getData());
            $offre->setTexteOffre($form->get("texte_offre")->getData());
            $offre->setPrix($form->get("prix")->getData());

            $entityManager->persist($offre);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        if ($id) {
            return $this->render('modif_offre/index.html.twig', [
                'controller_name' => 'OffreController',
                'offre' => $offre,
                'dispos' => $entityManager->getRepository(Disponibilites::class)->findBy(['id_offre' => $id]),
                'photos' => $entityManager->getRepository(Photo::class)->findBy(['id_offre' => $id]),
                'form' => $form,
            ]);
        }
        else {
            return $this->render('modif_offre/index.html.twig', [
                'controller_name' => 'OffreController',
                'offre' => null,
            ]);
        }

    }
    #[Route('/contact', name: 'contacter')]
    public function contact(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {

        $id = $request->query->get('id');

        if ($id) {
            $offre = $entityManager->getRepository(Offre::class)->find($id);

            if ($this->getUser()) {
                $session->set('currentDest', $offre->getIdUser()->getId());

                if (is_null($entityManager->getRepository(Message::class)->findOneBy(['id_utilisateur'=>$this->getUser(),'id_destinataire'=>$offre->getIdUser()]))) {
                    $message = new Message();
                    $message->setIdUtilisateur($this->getUser());
                    $message->setIdDestinataire($offre->getIdUser());
                    $message->setText("");
                    $currentDateTime = new \DateTimeImmutable();
                    $message->setDateMess($currentDateTime);
                    $entityManager->persist($message);
                    $entityManager->flush();
                }
                return $this->redirectToRoute('app_conversation');

            }
            return $this->redirectToRoute('app_login');

        }

        return $this->redirectToRoute('home');

    }
    #[Route('/offres/supprimer', name: 'supprimer_offre')]
    public function delete(Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $request->query->get('id');
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
