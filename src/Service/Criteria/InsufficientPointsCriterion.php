<?php

declare(strict_types=1);

namespace App\Service\Criteria;

use App\Dto\User;
use App\Dto\Voucher;

final class InsufficientPointsCriterion extends AbstractCriterion implements CriterionInterface
{
    public function matches(Voucher $voucher, User $user): bool
    {
        return $user->getPoints() < $voucher->getPointsCost();
    }

    public function getPriority(): int
    {
        return 1;
    }
}
