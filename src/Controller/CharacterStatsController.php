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

    public function getCharacterStats() {

        // tableau a générer via le form CreateCharacterStatsSession()
        $info = [
            ['id' => 1, 'name' => 'race', 'value' => 'Humain'],
            ['id' => 2, 'name' => 'planete d\'origine', 'value' => 'Terre']
        ];
        
        $carac = [
            ['id' => 1, 'name' => 'force', 'value' => 12],
            ['id' => 2, 'name' => 'intelligence', 'value' => 2]
        ];

        $competence = [];

        $inventaire = [];

        $statsAdditionnel = [];

        // stock les différent tableau
        $data = [
            'info' => $info,
            'carac' => $carac,
            'compétence' => $competence,
            'inventaire' => $inventaire,
            'statsAdditionnel' => $statsAdditionnel,
        ];

        return new JsonResponse($data);
    }
}
