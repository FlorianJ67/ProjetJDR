<?php

namespace App\Controller;

use App\Entity\Message;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    #[Route('/message', name: 'app_message')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $messages = $entityManager->getRepository(Message::class)->findAll();
        
        return $this->render('message/index.html.twig', [
            'messages' => $messages
        ]);
    }
}
