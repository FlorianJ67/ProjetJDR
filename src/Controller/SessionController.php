<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\MessageType;
use App\Form\SessionType;
use App\Form\CompetenceType;
use App\Form\CaracteristiqueType;
use App\Form\CollectionCompetenceType;
use App\Form\CaracteristiqueContenuType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\CollectionCaracteristiqueType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();

        if($user) {
            $sessions = $user->getSessions();
            
            return $this->render('session/index.html.twig', [
                'sessions' => $sessions,
            ]);    
        }
        // Si l'utilisateur n'est pas connecter rediriger sur la page de connexion
        return $this->redirectToRoute('app_login');
    }

    #[Route('/session/add', name: 'add_session')]
    public function add(ManagerRegistry $doctrine, EntityManagerInterface $entityManager, Request $request): Response
    {
        $sessionForm = $this->createForm(SessionType::class);
        $sessionForm->handleRequest($request);

        if($sessionForm->isSubmitted() && $sessionForm->isValid()){

            $session = $sessionForm->getData();
            $entityManager = $doctrine->getManager();

            $session->setGameMaster($user);
            // prepare
            $entityManager->persist($session);
            // insert into (execute)
            $entityManager->flush();

            return $this->redirectToRoute("info_session", ["id" => $session->getId()]);
        }

        $caracteristiqueForm = $this->createForm(CaracteristiqueType::class);
        $caracteristiqueForm->handleRequest($request);

        if($caracteristiqueForm->isSubmitted() && $caracteristiqueForm->isValid()){

            $caracteristique = $caracteristiqueForm->getData();
            $entityManager = $doctrine->getManager();

            // prepare
            $entityManager->persist($caracteristique);
            // insert into (execute)
            $entityManager->flush();

        }

        $caracteristiqueContenuForm = $this->createForm(CaracteristiqueContenuType::class);
        $caracteristiqueContenuForm->handleRequest($request);

        if($caracteristiqueContenuForm->isSubmitted() && $caracteristiqueContenuForm->isValid()){

            $caracteristiqueContenu = $caracteristiqueContenuForm->getData();
            $entityManager = $doctrine->getManager();

            // prepare
            $entityManager->persist($caracteristiqueContenu);
            // insert into (execute)
            $entityManager->flush();

        }

        $collectionCaracteristiqueForm = $this->createForm(CollectionCaracteristiqueType::class);
        $collectionCaracteristiqueForm->handleRequest($request);

        if($collectionCaracteristiqueForm->isSubmitted() && $collectionCaracteristiqueForm->isValid()){

            $collectionCaracteristique = $collectionCaracteristiqueForm->getData();
            $entityManager = $doctrine->getManager();

            // prepare
            $entityManager->persist($collectionCaracteristique);
            // insert into (execute)
            $entityManager->flush();

        }

        $competenceForm = $this->createForm(CompetenceType::class);
        $competenceForm->handleRequest($request);

        if($competenceForm->isSubmitted() && $competenceForm->isValid()){

            $competence = $competenceForm->getData();
            $entityManager = $doctrine->getManager();

            // prepare
            $entityManager->persist($competence);
            // insert into (execute)
            $entityManager->flush();

        }

        $collectionCompetenceForm = $this->createForm(CollectionCompetenceType::class);
        $collectionCompetenceForm->handleRequest($request);

        if($collectionCompetenceForm->isSubmitted() && $collectionCompetenceForm->isValid()){

            $collectionCompetence = $collectionCompetenceForm->getData();
            $entityManager = $doctrine->getManager();

            // prepare
            $entityManager->persist($collectionCompetence);
            // insert into (execute)
            $entityManager->flush();

        }

        return $this->render('session/add.html.twig', [
            'formAddSession' => $sessionForm->createView(),
            'formAddCaracteristique' => $caracteristiqueForm->createView(),
            'formAddCaracteristiqueContenu' => $caracteristiqueContenuForm->createView(),
            'formAddCollectionCaracteristique' => $collectionCaracteristiqueForm->createView(),
            'formAddCollectionCompetence' => $collectionCompetenceForm->createView(),
            'formAddCompetence' => $competenceForm->createView(),
        ]);
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
