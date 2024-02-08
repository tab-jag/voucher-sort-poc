<?php

declare(strict_types=1);

namespace App\Dto;

final class OfferedProduct
{
    public const CATEGORY_TYPE = 'category';

    public const PRODUCT_TYPE = 'product';

    public function __construct(private readonly string $type, private array $items)
    {
    }

    public static function category(array $items = []): self
    {
        return new self(self::CATEGORY_TYPE, $items);
    }

    public static function product(array $items = []): self
    {
        return new self(self::PRODUCT_TYPE, $items);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
