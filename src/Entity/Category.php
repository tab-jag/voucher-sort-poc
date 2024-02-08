<?php

declare(strict_types=1);

namespace App\Entity;

final class Category
{
    private array $foods;

    public function addFood(Food $food): self
    {
        $this->foods[] = $food;

        return $this;
    }

    public function getFoods(): array
    {
        return $this->foods;
    }

    public function setFoods(array $foods): Category
    {
        $this->foods = $foods;

        return $this;
    }
}
