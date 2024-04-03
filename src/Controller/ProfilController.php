<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\ProfilFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(Security $s, Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if ($user) {
            $form = $this->createForm(ProfilFormType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $user->setVille($form->get("ville")->getData());
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('app_profil');
            }

            return $this->render('profil/profil.html.twig', [
                'user' => $user,
                'profilForm' => $form,
            ]);
        }
        return $this->redirectToRoute('app_login');
    }
    #[Route('/modifierDonnees', name: 'modifierDonnees')]

    public function modifierDonnees(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer la valeur booléenne envoyée par le formulaire
        $nouvelleValeur = filter_var($request->request->get('nouvelle_valeur'), FILTER_VALIDATE_BOOLEAN);
        $user = $this->getUser();
        $user_id = $user->getUserIdentifier();
        $user = $this->getUser();
        //$user->addOffres($offre);

        $userRepository = $entityManager->getRepository(Utilisateur::class);
        $userEntity = $userRepository->findOneByEmail($user_id);
        $userEntity->setEnSommeil($nouvelleValeur) ;

        $entityManager->persist($userEntity) ;
        $entityManager->flush();        


        // Rediriger l'utilisateur vers une autre page
        return $this->redirectToRoute('app_profil');
    }
}
