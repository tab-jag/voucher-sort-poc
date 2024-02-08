<?php

declare(strict_types=1);

namespace App\Dto;

final class User
{
    public function __construct(private int $points)
    {
    }

    public function getPoints(): int
    {
        return $this->points;
    }
}
