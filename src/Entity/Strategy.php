<?php

namespace App\Entity;

class Strategy
{
    private string $name;
    private bool   $choice;

    private bool   $isThinking;

    public function choice(array $choices): void
    {
        dd($choices);
        if (isset($choices[-1])) {
            $this->setChoice($choices[-1]);
        }
    }

    // Constructor, Getters, and Setters
    public function __construct(string $name, bool $choice, bool $isThinking)
    {
        $this->name        = $name;
        $this->choice = $choice;
        $this->isThinking  = $isThinking;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getchoice(): bool
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

    public function setchoice(bool $choice): static
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
