<?php

declare(strict_types=1);

namespace App\Service\Criteria;

use App\Dto\User;
use App\Dto\Voucher;

final class NoPointsRequiredCriterion extends AbstractCriterion implements CriterionInterface
{
    public function matches(Voucher $voucher, User $user): bool
    {
        return $voucher->getPointsCost() === 0;
    }

    public function getPriority(): int
    {
        return 5;
    }
}
