<?php

namespace App\Entity\Strategies;

use App\Entity\Strategy;
use App\Enum\StrategyChoice;

class Undecided extends Strategy
{
    public function __construct()
    {
        parent::__construct(
            'Indécis',
            rand(0, 1) != 0 ? StrategyChoice::RESIST : StrategyChoice::COLLABORATE,
            true
        );
    }

    public function choose(array $choices): void
    {
        $this->setChoice(rand(0, 1) != 0 ? StrategyChoice::RESIST : StrategyChoice::COLLABORATE);
    }
}