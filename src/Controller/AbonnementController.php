<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\InscriptionAnnuelle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class AbonnementController extends AbstractController
{
    #[Route('/abonnement', name: 'app_abonnement')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('app_login');
        }
        $abonnement = $this->findAbonnemnet($entityManager);
        return $this->render('abonnement/index.html.twig', [
            'abonnement' => $abonnement
        ]);
    }

    #[Route('/newAbonnement', name: 'app_new_abonnement')]
    public function newAbonnement(Request $request, EntityManagerInterface $entityManager)
    {
        $abonnement = new InscriptionAnnuelle();
        $user = $this->getUser();
        $abonnement->setIdUser($user);
        $date = date('d-m-Y');
        $date = date('d-m-Y', strtotime("+1 year $date"));
        $date = new \DateTime($date);
        $abonnement->setDateExpiration($date);
        $entityManager->persist($abonnement);
        $entityManager->flush();
        return $this->redirectToRoute('app_abonnement');
    }

    #[Route('/updateAbonnement', name: 'app_update_abonnement')]
    public function updateAbonnement(Request $request, EntityManagerInterface $entityManager)
    {
        $abonnement = $this->findAbonnemnet($entityManager);
        $date = $abonnement->getDateExpiration()->format('d-m-Y');
        $date = strtotime("+1 year $date");
        $abonnement->setDateExpiration($abonnement->getDateExpiration());
        $entityManager->persist($abonnement);
        $entityManager->flush();
        return $this->redirectToRoute('app_abonnement');
    }

    #[Route('/removeAbonnement', name: 'app_remove_abonnement')]
    public function removeAbonnement(Request $request, EntityManagerInterface $entityManager)
    {
        $abonnement = $this->findAbonnemnet($entityManager);
        $entityManager->remove($abonnement);
        $entityManager->flush();
        return $this->redirectToRoute('app_abonnement');
    }

    public function findAbonnemnet($entityManager)
    {
        $user = $this->getUser();
        return $entityManager->getRepository(InscriptionAnnuelle::class)->find($user);
    }

}
