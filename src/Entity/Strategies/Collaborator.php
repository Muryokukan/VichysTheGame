<?php

namespace App\Entity\Strategies;

use App\Entity\Strategy;
use App\Enum\StrategyChoice;

/**
 * Collaborator strategy. This strategy always chooses the same choice as the opponent's last move.
 */
class Collaborator extends Strategy
{
    public function __construct()
    {
        parent::__construct('Collaborateur', StrategyChoice::COLLABORATE, true);
    }

    public function choose(array $choices): void
    {
        $this->setChoice(end($choices));
    }
}