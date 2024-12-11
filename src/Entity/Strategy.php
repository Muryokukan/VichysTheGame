<?php

namespace App\Entity;

class Strategy
{
    private string $name;
    private bool   $choice;

    private bool $isThinking;

    /**
     * Method to copy the last choice of an opponent.
     * @param array $choices Array of boolean values representing choices made by the opponent
     */
    public function choice(array $choices): void
    {
        $this->setChoice(end($choices));
    }

    // Constructor, Getters, and Setters
    public function __construct(string $name, bool $choice, bool $isThinking)
    {
        $this->name       = $name;
        $this->choice     = $choice;
        $this->isThinking = $isThinking;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getChoice(): bool
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

    public function setChoice(bool $choice): static
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
