<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AjoutAbonnementController extends AbstractController
{
    #[Route('/ajout_abonnement', name: 'app_ajout_abonnement')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();

        if(false){
            return $this->redirectToRoute('app_login');
        }
        $date = '2010-09-16';
        $date = $this->findDateProchaineExpiration($date);
        return $this->render('ajout_abonnement/index.html.twig', [
            'date' => $date,
        ]);
    }

    public function findAbonnement($entityManager, $user): ?Date
    {
        $queryBuilder = $entityManager->createQueryBuilder();

        $query = $entityManager->createQuery(
            'SELECT i.date_expiration
            FROM App\Entity\InscriptionAnnuelle i
            JOIN App\Entity\Utilisateur u ON 
            WHERE u.email = :user'
        )->setParameter('user', $user);

        return $query->getOneOrNullResult();
    }

    public function findDateProchaineExpiration($date): String
    {
        if($date == 0){
            $date = date('d-m-Y');
            $date = date('d-m-Y', strtotime("+12 months $date"));
        }else{
            $date = date('d-m-Y', strtotime("+12 months $date"));
        }
        return $date;
    }

    public function updateDateExpiration($entityManager, $user)
    {
        $queryBuilder = $entityManager->createQueryBuilder();

        $query = $entityManager->createQuery(
            'UPDATE i.date_expiration
            FROM App\Entity\InscriptionAnnuelle i
            JOIN App\Entity\Utilisateur u ON 
            WHERE u.email = :user'
        )->setParameter('user', $user);

        return $query->getOneOrNullResult();
    }
}
