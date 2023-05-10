<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Session;
use App\Form\MessageType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(): Response
    {
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }

    #[Route('/session/{id}', name: 'info_session')]
    public function info(ManagerRegistry $doctrine, Session $session, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(messageType::class);

        if($form->isSubmitted() && $form->isValid()){

            $message = $form->getData();
            $entityManager = $doctrine->getManager();

            $message->setAuthor($this->getUser());
            $message->setSession($session);

            $entityManager->persist($message);
            // insert into (execute)
            $entityManager->flush();

        }


        return $this->render('session/info.html.twig', [
            'session' => $session,
            'formAddMessage' => $form->createView(),
        ]);
    }
}
