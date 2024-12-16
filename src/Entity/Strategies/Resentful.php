<?php

namespace App\Entity\Strategies;

use App\Entity\Strategy;
use App\Enum\StrategyChoice;

class Resentful extends Strategy {
    public function __construct(){
        parent::__construct('Resentful', StrategyChoice::COLLABORATE, true);
    }

    public function choose(array $choices) : void {
        throw new \LogicException("This strategy does not change it's choice");
    }
}
