<?php

declare(strict_types=1);

namespace App\Service\Criteria;

use App\Dto\OfferedProduct;
use App\Dto\User;
use App\Dto\Voucher;

final class OutOfStockCriterion extends AbstractCriterion implements CriterionInterface
{
    public function matches(Voucher $voucher, User $user): bool
    {
        return false; // disabled this for now

        $offeredProduct = $voucher->getOfferedProduct();

        if ($offeredProduct === null && $voucher->getType() !== Voucher::GIFT_TYPE) {
            return false;
        }

        $items = $offeredProduct->getItems();

        if (empty($items)) {
            // This means it does not have SKU
            return false;
        }

        // At this point, it should have at least one item
//        if ($offeredProduct->getType() === OfferedProduct::CATEGORY_TYPE) {
//
//        }

        // added this as a placeholder
        return true;
    }

    public function getPriority(): int
    {
        return 2;
    }

    public function getPosition(): int
    {
        return 4;
    }
}

