<?php

namespace App\Entity\Strategies;

use App\Entity\Strategy;
use App\Enum\StrategyChoice;

class Collaborator extends Strategy {
    public function __construct(){
        parent::__construct('Collaborateur', StrategyChoice::COLLABORATE, false);
    }

    public function choose(array $choices) : void {
        $this->setChoice(end($choices));
    }
}