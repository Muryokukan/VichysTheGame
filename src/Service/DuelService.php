<?php

namespace App\Service;

use App\Enum\StrategyChoice;


class DuelService
{
    /**
     * Iterate through the 10 rounds of the duel and return the choices made by each strategy
     * @param array $strategies Array of Strategy objects
     * @return array Array containing the choices made by the strategies in each iteration of the duel
     */
    public function iterate(array $strategies): array
    {
        // Initialize choices array
        $choices = [
            'strategy0' => [],
            'strategy1' => [],
        ];
        // Duel iteration
        for ($i = 0; $i < 10; $i++) {
            // Check for strategy choice change
            foreach ($strategies as $key => $strategy) {
                if ($strategy->isThinking() && $i != 0) {
                    // Get previous choices for the opposing strategy
                    $opposingKey     = ($key == 0) ? 1 : 0;
                    $previousChoices = $choices["strategy$opposingKey"];
                    // Apply the opposing strategy's choices to the current strategy
                    $strategy->choose($previousChoices);
                }
                // Record the choice made for current strategy
                $choices["strategy$key"][] = $strategy->getChoice();
            }
        }
        return $choices;
    }

    /**
     * Evaluate the outcome of the duel and return the total scores for each strategy
     * @param mixed $choices Array containing the choices made by the strategies in each iteration of the duel
     * @return array Total scores for each strategy in the duel
     */
    public function evaluate($choices): array
    {
        $scores = [
            'strategy0' => 0,
            'strategy1' => 0,
        ];
        for ($i = 0; $i < count($choices['strategy0']); $i++) {
            $choice0 = $choices['strategy0'][$i];
            $choice1 = $choices['strategy1'][$i];

            // If both strategy chose to collaborate
            if ($choice0 == $choice1 && $choice0 == StrategyChoice::COLLABORATE) {
                $scores['strategy0'] += 3;
                $scores['strategy1'] += 3;
                // If both strategy chose to resist
            } elseif ($choice0 == $choice1 && $choice0 == StrategyChoice::RESIST) {
                $scores['strategy0'] += 1;
                $scores['strategy1'] += 1;
                // If the first strategy chose to collaborate and the second chose to resist
            } elseif ($choice0 != $choice1) {
                if ($choice0 == StrategyChoice::COLLABORATE) {
                    $scores['strategy1'] += 5;
                } else {
                    $scores['strategy0'] += 5;
                }
            }
        }
        return $scores;
    }
}