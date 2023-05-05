<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\JsonResponse;

class CharacterStatsController extends AbstractController
{
    #[Route('/character/stats', name: 'app_character_stats')]
    public function index(): Response
    {
        return $this->render('character_stats/index.html.twig', [
            'controller_name' => 'CharacterStatsController',
        ]);
    }

    #[Route('/character/stats/carac', name: 'carac_character_stats')]

    public function getCaracteristiques() {
        $carac = [
            ['id' => 1, 'name' => 'force', 'value' => 12],
            ['id' => 2, 'name' => 'intéligence', 'value' => 2]
        ];

        $data = [
            'carac' => $carac,
        ];

        return new JsonResponse($data);
    }
}
