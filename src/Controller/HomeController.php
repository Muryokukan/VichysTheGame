<?php

namespace App\Controller;

use App\Entity\Strategies\Collaborator;
use App\Entity\Strategies\Undecided;
use App\Service\DuelService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(DuelService $duelService): Response
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

        // dd($results);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'results'         => $results,
        ]);
    }
}
