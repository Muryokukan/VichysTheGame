<?php

namespace App\Controller;

use App\Entity\Strategies\Opportunist;
use App\Entity\Strategies\Strategist;
use App\Entity\Strategy;
use App\Entity\Strategies\Nazi;
use App\Service\TournamentService;
use App\Entity\Strategies\Resistant;
use App\Entity\Strategies\Undecided;
use App\Entity\Strategies\Collaborator;
use App\Service\DuelService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/score')]
class ScoreController extends AbstractController
{
    #[Route('/tournoi', name: 'app_tournament')]
    public function tournoi(TournamentService $tournamentService): Response
    {
        // TODO: Implement strategies choice by user
        $chosenStrategies = [
            new Collaborator(),
            new Undecided(),
            new Nazi(),
            new Resistant(),
            new Strategist(),
            new Opportunist(),
        ];

        // Prepare user given strategies for use in the tournamentService
        $strategies = [];
        for ($i = 0; $i < count($chosenStrategies); $i++) {
            // Assign unique names for each strategy to avoid conflicts in the tournamentService
            // eg: "Collaborator 0", "Undecided 1", ...
            $strategies[$chosenStrategies[$i]->getName() . " $i"] = $chosenStrategies[$i];
        }

        // Conduct tournament
        $tournamentResults = $tournamentService->conductTournament($strategies);

        return $this->render('score/tournoi.html.twig', [
            'tournamentResults' => $tournamentResults,
        ]);
    }

    #[Route('/duel', name: 'app_duel')]
    public function duel(DuelService $duelService): Response
    {
        // Create two strategies
        $strategy0 = new Collaborator();
        $strategy1 = new Undecided();

        $strategies = [$strategy0, $strategy1];
        // Simulate a duel
        $choices = $duelService->iterate($strategies);
        $scores  = $duelService->evaluate($choices);

        $results = [];
        foreach ($strategies as $index => $strategy) {
            $strategyKey = "strategy$index";
            $results[]   = [
                'name'    => $strategy->getName(),
                'choices' => $choices[$strategyKey],
                'score'   => $scores[$strategyKey],
            ];
        }

        return $this->render('score/duel.html.twig', [
            'results' => $results,
        ]);
    }
}
