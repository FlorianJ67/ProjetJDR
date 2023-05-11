<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Session;
use App\Form\MessageType;
use App\Form\SessionType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(ManagerRegistry $doctrine,EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();

        if($user) {
            $sessions = $user->getSessions();

            // Formulaire de création de Session
            $form = $this->createForm(SessionType::class);
            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                $session = $form->getData();
                $entityManager = $doctrine->getManager();

                $session->setGameMaster($user);

                $entityManager->persist($session);
                $entityManager->flush();
     
            }
            return $this->render('session/index.html.twig', [
                'sessions' => $sessions,
                'formAddSession' => $form->createView(),
            ]);    
        }
        // Si l'utilisateur n'est pas connecter rediriger sur la page de connexion
        return $this->redirectToRoute('app_login');
    }

    #[Route('/session/{id}', name: 'info_session')]
    public function info(ManagerRegistry $doctrine, Session $session, EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(MessageType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            $message = $form->getData();
            $entityManager = $doctrine->getManager();
            
            $now = new \DateTime();
            $message->setCreationDate($now);

            $message->setAuthor($this->getUser());
            $message->setSession($session);
        
            $entityManager->persist($message);
            // insert into (execute)
            $entityManager->flush();

            return $this->redirectToRoute("info_session", ["id" => $session->getId()]);

        }
        return $this->render('session/info.html.twig', [
            'session' => $session,
            'formAddMessage' => $form->createView(),
        ]);
    }
}
