<?php

namespace App\Controller;

use App\Entity\Ruleset;
use App\Entity\Strategy;
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
        $strategy1 = new Strategy('Strategy 1', true, true);
        $strategy2 = new Strategy('Strategy 2', false, false);

        // Create a ruleset with these strategies
        $ruleset = new Ruleset([$strategy1, $strategy2]);

        // Simulate a duel
        $result = $duelService->iterate($ruleset);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'duel_result'     => $result,
        ]);
    }
}
