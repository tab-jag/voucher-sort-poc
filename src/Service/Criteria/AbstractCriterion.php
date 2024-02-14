<?php

declare(strict_types=1);

namespace App\Service\Criteria;

abstract class AbstractCriterion
{
    protected array $items = [];
    public function getName(): string
    {
        return static::class;
    }

    public function add(mixed $item): void
    {
        $this->items[] = $item;
    }

    public function getValues(): array
    {
        return $this->items;
    }
}
