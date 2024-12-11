<?php

namespace App\Entity\Strategies;

use App\Entity\Strategy;
use App\Enum\StrategyChoice;

class Nazi extends Strategy {
    public function __construct(){
        parent::__construct('Nazi', StrategyChoice::COLLABORATE, false);
    }

    public function choose(array $choices) : void {
        throw new \LogicException("This strategy does not change it's choice");
    }
}