<?php

namespace App\Controller;

use App\Entity\Strategies\Collaborator;
use App\Entity\Strategies\Nazi;
use App\Entity\Strategies\Resistant;
use App\Entity\Strategies\Undecided;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TournamentService;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TournamentService $tournamentService): Response
    {
        // TODO: Implement strategies choice by user
        $chosenStrategies = [
            new Collaborator(),
            new Undecided(),
            new Nazi(),
            new Resistant(),
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

        return $this->render('home/index.html.twig', [
            'controller_name'   => 'HomeController',
            'tournamentResults' => $tournamentResults,
        ]);
    }
}