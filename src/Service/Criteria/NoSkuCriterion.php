<?php

declare(strict_types=1);

namespace App\Service\Criteria;

use App\Dto\User;
use App\Dto\Voucher;

final class NoSkuCriterion extends AbstractCriterion implements CriterionInterface
{
    public function matches(Voucher $voucher, User $user): bool
    {
        $offeredProduct = $voucher->getOfferedProduct();

        return $offeredProduct !== null && count($offeredProduct->getItems()) === 0;
    }

    public function getPriority(): int
    {
        return 3;
    }
}
