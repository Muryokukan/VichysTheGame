<?php

namespace App\Entity\Strategies;

use App\Entity\Strategy;
use App\Enum\StrategyChoice;

/**
 * Resistant strategy. This strategy always chooses to resist.
 */
class Resistant extends Strategy {
    public function __construct(){
        parent::__construct('Résistant', StrategyChoice::RESIST, false);
    }

    public function choose(array $choices) : void {
        throw new \LogicException("This strategy does not change it's choice");
    }
}