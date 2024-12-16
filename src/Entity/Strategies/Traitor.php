<?php

namespace App\Entity\Strategies;

use App\Entity\Strategy;
use App\Enum\StrategyChoice;

/**
 * Traitor strategy. This strategy chooses to resist, until round 5 where it changes its choice to collaborate.
 */
class Traitor extends Strategy
{
    public function __construct()
    {
        parent::__construct('Traitor', StrategyChoice::RESIST, true);
    }

    public function choose(array $choices): void
    {
        if (count($choices) > 5) {
            $this->setChoice(StrategyChoice::COLLABORATE);
        }
    }

}