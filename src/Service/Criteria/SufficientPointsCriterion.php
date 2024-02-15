<?php

declare(strict_types=1);

namespace App\Service\Criteria;

use App\Dto\User;
use App\Dto\Voucher;

final class SufficientPointsCriterion extends AbstractCriterion implements CriterionInterface
{
    public function matches(Voucher $voucher, User $user): bool
    {
        return $voucher->getPointsCost() > 0 && $user->getPoints() >= $voucher->getPointsCost();
    }

    public function getPriority(): int
    {
        return 4;
    }

    public function getPosition(): int
    {
        return 2;
    }
}
