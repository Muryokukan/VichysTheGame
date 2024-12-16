<?php

namespace App\Entity\Strategies;

use App\Entity\Strategy;
use App\Enum\StrategyChoice;

/**
 * Strategist strategy. This strategy chooses its choice based on the opponent's behavior
 * if the opponent collaborates more often, it chooses to collaborate, otherwise it chooses to resist.
 * if the opponent's strategy is mixed, it uses their last move.
 */
class Strategist extends Strategy {
    public function __construct(){
        parent::__construct('Strategist', StrategyChoice::COLLABORATE, true);
    }

    public function choose(array $choices): void
    {
        $collaborationCount = 0;

        // Count the opponent's collaboration
        foreach ($choices as $choice) {
            if ($choice === StrategyChoice::COLLABORATE) {
                $collaborationCount++;
            }
        }

        // Calculate the opponent's collaboration ratio
        $totalMoves = count($choices);
        $collaborationRatio = $collaborationCount / $totalMoves;

        // Make a decision based on the opponent's behavior
        if ($collaborationRatio >= 0.7) {
            // If the opponent collaborates often, collaborate to maximize mutual benefit
            $this->setChoice(StrategyChoice::COLLABORATE);
        } elseif ($collaborationRatio <= 0.5) {
            // If the opponent resists often, resist to minimize losses
            $this->setChoice(StrategyChoice::RESIST);
        } else {
            // If the opponent's strategy is mixed, use their last move
            $lastChoice = end($choices);
            $this->setChoice($lastChoice === StrategyChoice::COLLABORATE ? StrategyChoice::COLLABORATE : StrategyChoice::RESIST);
        }
    }

}