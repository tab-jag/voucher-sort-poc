<?php

declare(strict_types=1);

namespace App\Entity;

final class Food
{
    public const AVAILABLE = 'available';

    public const DISABLED = 'disabled';

    public const UNAVAILABLE = 'unavailable';

    public function __construct(private string $id, private string $availability)
    {
    }

    public static function available(string $id): self
    {
        return new self($id, self::AVAILABLE);
    }

    public static function disabled(string $id): self
    {
        return new self($id, self::DISABLED);
    }

    public static function unavailable(string $id): self
    {
        return new self($id, self::UNAVAILABLE);
    }

    public function getAvailability(): string
    {
        return $this->availability;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setAvailability(string $availability): Food
    {
        $this->availability = $availability;

        return $this;
    }

    public function setId(string $id): Food
    {
        $this->id = $id;

        return $this;
    }
}
