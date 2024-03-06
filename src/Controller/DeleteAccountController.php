<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\DeleteAccountFormType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteAccountController extends AbstractController
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[Route('/supprimerCompte', name: 'supprimer_compte')]
    public function supprimerCompte(Request $request, Utilisateur $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DeleteAccountFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->container->get('security.token_storage')->setToken(null);

            $entityManager->remove($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('profil/delete.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}