<?php

namespace App\Controller;

use App\Entity\Disponibilites;
use App\Entity\Offre;
use App\Entity\Photo;
use App\Entity\Reservation;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeOffreController extends AbstractController
{
    #[Route('/offres', name: 'app_liste_offre')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {

        return $this->render('liste_offre/index.html.twig', [
            'controller_name' => 'ListeOffreController',
            'offres' => $entityManager->getRepository(Offre::class)->findAll(),
        ]);
    }

    /**
     * @Route("/appliquer-filtres", methods={"POST"})
     */
    #[Route('/appliquer-filtres', methods: 'POST')]
    public function appliquerFiltres(EntityManagerInterface $entityManager, Request $request): Response
    {

        $this->render('liste_offre/index.html.twig', [
            'offres' => $entityManager->getRepository(Offre::class)->findAll(),
        ]);
        function removeAccents($string) {
            return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'))), ' '));
        }
        $data = json_decode($request->getContent(), true);

        $criteria = [];
        if ($data['nom'] != "") {
            $criteria['titre_offre'] = $data['nom'];
        }
        if ($data['minPrix'] != "") {
            $criteria['prix'] = [];
            $criteria['prix']['gte'] = $data['minPrix'];
        }

        if ($data['maxPrix'] != "") {
            $criteria['prix'] = $criteria['prix'] ?? [];
            $criteria['prix']['lte'] = $data['maxPrix'];
        }
        if ($data['codePostal'] != "") {
            $criteria['code_postal'] = $data['codePostal'];
        }
        if ($data['ville'] != "") {
            $criteria['ville'] =  removeAccents($data['ville']);
        }

        $villes = [];
        $utilisateurs = $entityManager->getRepository(Utilisateur::class)->findAll();

        foreach ($utilisateurs as $utilisateur) {
            $villes[$utilisateur->getId()] = removeAccents($utilisateur->getVille());
        }

        $qb = $entityManager->createQueryBuilder();
        $qb->select('o')
            ->from(Offre::class, 'o')
            ->join('o.id_user', 'u')
            ->where('u.id = o.id_user');

        foreach ($criteria as $key => $value) {
            if ($key === 'code_postal') {
                $qb->andWhere($qb->expr()->like("u.$key", ":$key"))
                    ->setParameter($key, "%$value%");
            }
            elseif ($key === 'ville') {
                if (in_array($value, array_values($villes))) {
                    $userwithVille = array_filter($villes, function($v) use ($value) {
                        return $v === $value;
                    });
                    $qb->andWhere($qb->expr()->in('u.id', array_keys($userwithVille)));
                }
            }
            elseif ($key === 'prix') {
                if (isset($value['gte'])) {
                    $qb->andwhere('o.prix >= :minPrix')
                        ->setParameter('minPrix', (float)$value['gte']);
                }
                if (isset($value['lte'])) {
                    $qb->andwhere('o.prix <= :maxPrix')
                        ->setParameter('maxPrix', (float)$value['lte']);
                }
            } elseif ($key === 'titre_offre') {
                $qb->andwhere($qb->expr()->like("o.$key", ":$key"))
                    ->setParameter($key, "%$value%");
            } else {
                $qb->andWhere("o.$key = :$key")
                    ->setParameter($key, $value);
            }
        }
        $offres = $qb->getQuery()->getResult();

        $villes = [];
        $utilisateurs = $entityManager->getRepository(Utilisateur::class)->findAll();

        foreach ($utilisateurs as $utilisateur) {
            $villes[$utilisateur->getId()] = removeAccents($utilisateur->getVille());
        }
        return $this->json(['dest'=> $criteria, 'offres' => array_map(function($r) {return [$r->getId(), $r->getTitreOffre(),$r->getPrix(),$r->getIdUser()->getPrenom(),$r->getIdUser()->getVille(), $r->getIdUser()->getCodepostal()];},$offres)]);
    }

}
