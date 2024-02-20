<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\ProfilFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $session = $request->getSession();
        $userSession = $session->get('user');
        $user = $entityManager->getRepository(Utilisateur::class)->findOneBy(['email'=>$userSession->getEmail()]);
        //print_r(app->user);
        if (!$user) {
            throw $this->createNotFoundException(
                'No User found for main : '. $userSession->getEmail()
            );
        }
        $form = $this->createForm(ProfilFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userAlreadyExist = $entityManager->getRepository(Utilisateur::class)->findOneBy(['email'=>$user->getEmail()]);
            if ($userAlreadyExist) {
                throw $this->createAccessDeniedException(
                    'Utilisateur déjà existant : '. $userAlreadyExist->getEmail()
                );
            } else {
                $entityManager->persist($user);
                $entityManager->flush();
                $session->set('user', $user);    // ou $form->get('email')
            }
            return $this->redirectToRoute('home');
        }

        return $this->render('profil/profil.html.twig', [
            'user' => $user,
            'profilForm' => $form->createView(),
        ]);
    }
}
