<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SupprimerAbonnementController extends AbstractController
{
    #[Route('/suppr_abonnement', name: 'app_suppr_abonnement')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();
        $isSuppr = $this->supprAbonnement($entityManager, $user);
        return $this->render('supprimer_abonnement/index.html.twig', [
            'isSuppr' => $isSuppr,
        ]);
    }

    public function supprAbonnement($entityManager, $user): boolval
    {
        $queryBuilder = $entityManager->createQueryBuilder();

        $query = $entityManager->createQuery(
            'DELETE 
            FROM App\Entity\InscriptionAnnuelle i
            INNER JOIN App\Entity\Utilisateur u
            WHERE u.email = :user'
        )->setParameter('user', $user);

        return $query->getOneOrNullResult();
    }
}