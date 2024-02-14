<?php

declare(strict_types=1);

namespace App\Service\Criteria;

use App\Dto\User;
use App\Dto\Voucher;

interface CriterionInterface
{
    public function matches(Voucher $voucher, User $user): bool;

    public function getPriority(): int;

    public function getName(): string;

    public function add(mixed $item): void;

    public function getValues(): array;
}
