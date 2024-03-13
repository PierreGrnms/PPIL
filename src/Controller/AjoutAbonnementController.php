<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class AjoutAbonnementController extends AbstractController
{
    #[Route('/ajout_abonnement', name: 'app_ajout_abonnement')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if(!$user){
            return $this->redirectToRoute('app_login');
        }
        $date = null;
        if($date == null){
            $date = date('d-m-Y');
        }
        $new_date = $this->findDateProchaineExpiration($date);
        return $this->render('abonnement/index.html.twig', [
            'date' => $new_date
        ]);
    }

    public function findAbonnement($entityManager, $user): ?Date
    {
        $queryBuilder = $entityManager->createQueryBuilder();

        $query = $entityManager->createQuery(
            'SELECT i.date_expiration
            FROM App\Entity\InscriptionAnnuelle i
            JOIN App\Entity\Utilisateur u 
            WHERE u.email = :user'
        )->setParameter('user', $user);

        return $query->getOneOrNullResult();
    }

    public function findDateProchaineExpiration($date): String
    {
        if($date == 0){
            $date = date('d-m-Y');
        }
        return date('d-m-Y', strtotime("+1 year $date"));
    }

    public function updateDateExpiration($entityManager, $user)
    {
        $queryBuilder = $entityManager->createQueryBuilder();

        $query = $entityManager->createQuery(
            'UPDATE i.date_expiration
            FROM App\Entity\InscriptionAnnuelle i
            JOIN App\Entity\Utilisateur u ON (id_user)
            WHERE u.email = :user'
        )->setParameter('user', $user);

        return $query->getOneOrNullResult();
    }
}
