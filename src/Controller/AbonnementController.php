<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AbonnementController extends AbstractController
{
    #[Route('/abonnement', name: 'app_abonnement')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();

        if($user){
            return $this->redirectToRoute('app_login');
        }
        $abo = $this->findAbonnement($entityManager, $user);
        return $this->render('abonnement/index.html.twig', [
            'date' => $abo,
        ]);
    }

    public function findAbonnement($entityManager, $user): ?Date
    {
        $queryBuilder = $entityManager->createQueryBuilder();

        $query = $entityManager->createQuery(
            'SELECT i.date_expiration
            FROM App\Entity\InscriptionAnnuelle i
            INNER JOIN App\Entity\Utilisateur u
            WHERE u.email = :user'
        )->setParameter('user', $user);

        return $query->getOneOrNullResult();
    }
}
