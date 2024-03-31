<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setVille($form->get("ville")->getData());
            $user->setPorteMonnaie(500);

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/villes', name: 'app_cities')]
    public function villes(Request $request): Response
    {
        $form = $this->createForm(PostalCodeFormType::class);
        $form->handleRequest($request);

        $cities = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $postalCode = $data['code_postal'];

            // Appel à GeoNamesService pour obtenir les villes françaises correspondant au code postal
            $cities = $geoNamesService->getCitiesByPostalCode($postalCode);
        }

        return $this->render('villes.html.twig', [
            'form' => $form->createView(),
            'cities' => $cities,
        ]);
    }
}
