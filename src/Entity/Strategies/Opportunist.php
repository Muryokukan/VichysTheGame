<?php

namespace App\Entity\Strategies;

use App\Entity\Strategy;
use App\Enum\StrategyChoice;

/**
 * Opportunist strategy. This strategy chooses to collaborate, until round 5 where it changes its choice to resist.
 */
class Opportunist extends Strategy
{
    public function __construct()
    {
        parent::__construct('Opportunist', StrategyChoice::COLLABORATE, true);
    }

    public function choose(array $choices): void
    {
        if (count($choices) > 5) {
            $this->setChoice(StrategyChoice::RESIST);
        }
    }

}