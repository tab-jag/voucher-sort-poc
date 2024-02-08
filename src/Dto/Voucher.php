<?php

declare(strict_types=1);

namespace App\Dto;

final class Voucher
{
    public const AMOUNT_TYPE = 'amount';

    public const GIFT_TYPE = 'gift';

    public const PERCENTAGE_TYPE = 'percentage';

    public function __construct(
        private string $id,
        private string $label,
        private int $pointsCost,
        private string $type,
        private ?OfferedProduct $offeredProduct = null
    ) {
    }

    public static function amount(
        string $id,
        string $label,
        int $pointsCost,
        ?OfferedProduct $offeredProduct = null
    ): self {
        return new self($id, $label, $pointsCost, self::AMOUNT_TYPE, $offeredProduct);
    }

    public static function gift(
        string $id,
        string $label,
        int $pointsCost,
        ?OfferedProduct $offeredProduct = null
    ): self {
        return new self($id, $label, $pointsCost, self::GIFT_TYPE, $offeredProduct);
    }

    public static function percentage(
        string $id,
        string $label,
        int $pointsCost,
        ?OfferedProduct $offeredProduct = null
    ): self {
        return new self($id, $label, $pointsCost, self::PERCENTAGE_TYPE, $offeredProduct);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getOfferedProduct(): ?OfferedProduct
    {
        return $this->offeredProduct;
    }

    public function getPointsCost(): int
    {
        return $this->pointsCost;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
