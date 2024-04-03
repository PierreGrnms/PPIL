<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\NotSupported;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;


class ConversationController extends AbstractController
{
    /**
     * @throws NotSupported
     */
    #[Route('/conversation', name: 'app_conversation')]
    public function index(EntityManagerInterface $entityManager, Request $request, SessionInterface $session): Response
    {
        if ($request->query->get('remove')) {
            $session->set("currentDest", null);
            return $this->redirectToRoute('app_conversation');
        }
        if ($this->getUser()) {
            $queryBuilder = $entityManager->createQueryBuilder();
            $queryBuilder->select('m')
                ->from(Message::class, 'm')
                ->where('m.text = :nothing')
                ->andWhere('m.id_utilisateur = :user')
                ->setParameter('user', $this->getUser())
                ->setParameter('nothing', "");
            $receiver = array_map(function($r) {
                return $r->getIdDestinataire();
            }, $queryBuilder->getQuery()->getResult());
            $queryBuilder->select('a')
                ->from(Message::class, 'a')
                ->where('m.text != :nothing')
                ->andWhere('m.id_destinataire = :user')
                ->groupBy('m.id_destinataire')
                ->setParameter('user', $this->getUser())
                ->setParameter('nothing', "");;

            $sender = array_map(function($r) {
                return $r->getIdUtilisateur();
            }, $queryBuilder->getQuery()->getResult());
           /* $queryBuilder
                ->select('m')
                ->from(Message::class, 'm')
                ->where('m.text = :nothing')
                ->andWhere('(m.id_utilisateur = :user OR m.id_destinataire = :user)')
                ->orderBy('m.date_mess', 'ASC')
                ->setParameter('user', $this->getUser())
                ->setParameter('nothing', "");*/

            $destinataires = array_merge($receiver, $sender);

            return $this->render('conversation/index.html.twig', [
                'controller_name' => 'ConversationController',
                'destinataires' => $destinataires,
                'currentDest' => $session->get('currentDest'),
            ]);
        }
        return $this->redirectToRoute('app_login');

    }
    /**
     * @Route("/send-message", methods={"POST"})
     */
    /*#[Route('/send-message', methods: 'POST')]*/
    public function addMessage(EntityManagerInterface $entityManager, Request $request, SessionInterface $session, HubInterface $hub): Response
    {

        /*return new Response('published');*/
        $data = json_decode($request->getContent(),true);
        $dest = $entityManager->getRepository(Utilisateur::class)->findOneBy(['id' => $session->get('currentDest')]);

        $message = new Message();
        $message->setIdUtilisateur($this->getUser());
        $message->setIdDestinataire($dest);
        $message->setText($data['message']);
        $currentDateTime = new \DateTimeImmutable();
        $message->setDateMess($currentDateTime);

        $entityManager->persist($message);
        $entityManager->flush();

        $update = new Update("https://Nearmessage.com/message", json_encode(["dest"=>$dest->getId()]));
        $hub->publish($update);

        return $this->json(['dest'=> $dest->getPrenom(),'message' => $data['message']]);

    }
    /**
     * @Route("/conversation-change-event", name="app_change_event", methods={"POST"})
     */
    /*#[Route('/conversation-change-event', name: 'app_change_event', methods: 'POST')]*/
    public function handleConvChange(EntityManagerInterface $entityManager, Request $request, SessionInterface $session): JsonResponse
    {
        $data = json_decode($request->getContent(),true);

        $dest = $entityManager->getRepository(Utilisateur::class)->findOneBy(['id' => $data["destinataire"]]);
        $session->set('currentDest', $dest->getId());
        $queryBuilder = $entityManager->createQueryBuilder();
        /*$queryBuilder
            ->select('identity(m.id_utilisateur)','identity(m.id_destinataire)','m.text', 'm.date_mess') //
            ->from(Message::class, 'm')
            ->where('m.id_utilisateur = :user')
            ->andWhere('m.id_destinataire = :dest')
            ->orWhere('m.id_utilisateur = :dest')
            ->orWhere('m.id_destinataire = :user')
            ->orderBy('m.date_mess', 'ASC')
            ->setParameter('user', $this->getUser())
            ->setParameter('dest', $dest);*/
        $queryBuilder
            ->select('identity(m.id_utilisateur)', 'identity(m.id_destinataire)', 'm.text', 'm.date_mess')
            ->from(Message::class, 'm')
            ->where('(m.id_utilisateur = :user AND m.id_destinataire = :dest)')
            ->orWhere('(m.id_utilisateur = :dest AND m.id_destinataire = :user)')
            ->orderBy('m.date_mess', 'ASC')
            ->setParameter('user', $this->getUser())
            ->setParameter('dest', $dest);
        $messages = $queryBuilder->getQuery()->getResult();










        return $this->json(['user'=> $this->getUser()->getId(),'messages' => $messages]);
    }
}
