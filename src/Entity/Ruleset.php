<?php

namespace App\Entity;

class Ruleset {
    private array $strategies;

    // Constructor, Getters, and Setters
    public function __construct(array $strategies)
    {
        $this->strategies = $strategies;
    }

    public function getStrategies(): array {
        return $this->strategies;
    }

    public function addStrategy(Strategy $strategy) {
        $this->strategies[] = $strategy;
        return $this;
    }

    public function removeStrategy(Strategy $strategy) : static {
        unset($this->strategies[array_search($strategy, $this->strategies)]);
        return $this;
    }
}