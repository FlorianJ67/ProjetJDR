<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\MessageType;

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
    // #[IsGranted("ROLE_USER")]
    public function info(Session $session): Response
    {
        $form = $this->createForm(messageType::class);

        return $this->render('session/info.html.twig', [
            'formAddMessage' => $form->createView(),
            'session' => $session,
        ]);
    }
}
