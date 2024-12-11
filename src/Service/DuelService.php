<?php

namespace App\Service;

use App\Entity\Ruleset;

class DuelService
{
    public function iterate(Ruleset $ruleset): array
    {
        // Initialize choices array
        $choices = [
            'strategy0' => [],
            'strategy1' => [],
        ];
        // Duel iteration
        for ($i = 0; $i < 10; $i++) {
            // Check for strategy choice change
            foreach ($ruleset->getStrategies() as $key => $strategy) {
                if ($strategy->isThinking() && $i != 0) {
                    // Get previous choices for the opposing strategy
                    $opposingKey = ($key == 0) ? 1 : 0;
                    $previousChoices = $choices["strategy$opposingKey"];
                    // Apply the opposing strategy's choices to the current strategy
                    $strategy->choice($previousChoices);
                }
                // Record the choice made for current strategy
                $choices["strategy$key"][] = $strategy->getChoice();
            }
        }
        return $choices;
    }
}
