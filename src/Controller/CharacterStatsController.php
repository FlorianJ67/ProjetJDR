<?php

namespace App\Controller;

use App\Form\CharacterStatsType;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CharacterStatsController extends AbstractController
{
    #[Route('/character/stats', name: 'app_character_stats')]
    public function index(): Response
    {
        return $this->render('character_stats/index.html.twig', [
            'controller_name' => 'CharacterStatsController',
        ]);
    }

    #[Route('/character/stats/add', name: 'add_character_stats')]
    public function addCharacterStats(ManagerRegistry $doctrine, Request $request): Response
    {

        // Formulaire de création de Fiche Personnage
        $form = $this->createForm(CharacterStatsType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $characterStats = $form->getData();
            $entityManager = $doctrine->getManager();

            $entityManager->persist($characterStats);
            $entityManager->flush();
 
        }

        return $this->render('character_stats/index.html.twig', [
            'formAddCharacterStats' => $form->createView(),
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
