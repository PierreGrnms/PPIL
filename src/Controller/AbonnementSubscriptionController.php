<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AbonnementSubscriptionController extends AbstractController
{
    #[Route('/abonnement', name: 'app_abonnement_subscription')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();
        $abo = $this->findAbonnement($entityManager, $user);

        if($user == null){
            return $this->render('home_page/index.html.twig', [
                'user' => $user,
            ]);
        }
        $abo = findAbonnement($entityManager, $user);
        if($abo == null){
            return $this->render('abonnement/subscription.html.twig');
        }
        return $this->render('abonnement/abonnement.html.twig', [
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
