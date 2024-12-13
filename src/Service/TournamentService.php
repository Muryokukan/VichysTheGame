<?php

namespace App\Service;

use App\Entity\Strategy;

class TournamentService
{

    private DuelService $duelService;

    public function __construct(DuelService $duelService)
    {
        $this->duelService = $duelService;
    }

    /**
     * Conduct a tournament between multiple strategies
     * @param Strategy[] $strategies Array of Strategy objects
     * @return array Tournament results
     */
    public function conductTournament(array $strategies): array
    {
        $results     = [];
        $totalScores = array_fill_keys(array_keys($strategies), 0);

        // Conduct duels between each pair of strategies
        $strategyKeys = array_keys($strategies);
        foreach ($strategyKeys as $i => $key0) {
            for ($j = $i + 1; $j < count($strategyKeys); $j++) {
                $key1           = $strategyKeys[$j];
                $duelStrategies = [$strategies[$key0], $strategies[$key1]];
                $choices        = $this->duelService->iterate($duelStrategies);
                $scores         = $this->duelService->evaluate($choices);

                // Record the results
                $results[] = [
                    'strategies' => [$key0, $key1],
                    'choices'    => $choices,
                    'scores'     => $scores
                ];

                // Update total scores
                $totalScores[$key0] += $scores['strategy0'];
                $totalScores[$key1] += $scores['strategy1'];
            }
        }

        // Sort strategies by total score
        arsort($totalScores);

        return [
            'duelResults' => $results,
            'totalScores' => $totalScores
        ];
    }
}