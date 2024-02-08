<?php

declare(strict_types=1);

namespace App\Entity;

final class FoodPos
{
    public function __construct(private string $id)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): FoodPos
    {
        $this->id = $id;

        return $this;
    }
}
