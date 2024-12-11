<?php

namespace App\Entity;

use App\Enum\StrategyChoice;

abstract class Strategy
{
    private string $name;
    private StrategyChoice   $choice;
    private bool   $isThinking;

    /**
     * Method to copy the last choice of an opponent.
     * @param array $choices Array of StrategyChoice representing choices made by the opponent
     */
    abstract public function choose(array $choices): void;

    // Constructor, Getters, and Setters
    public function __construct(string $name, StrategyChoice $choice, bool $isThinking)
    {
        $this->name       = $name;
        $this->choice     = $choice;
        $this->isThinking = $isThinking;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getChoice(): StrategyChoice
    {
        return $this->choice;
    }

    public function isThinking(): bool
    {
        return $this->isThinking;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function setChoice(StrategyChoice $choice): static
    {
        $this->choice = $choice;
        return $this;
    }

    public function setIsThinking(bool $isThinking): static
    {
        $this->isThinking = $isThinking;
        return $this;
    }
}
