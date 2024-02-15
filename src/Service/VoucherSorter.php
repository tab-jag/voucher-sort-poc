<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\OfferedProduct;
use App\Dto\User;
use App\Dto\Voucher;

final class VoucherSorter implements VoucherSorterInterface
{
    private User $user;

    public function __construct(
        private readonly VoucherSorterCriteriaInterface $criteria,
    )
    {
    }

    public function sortByCriteria(User $user, array $vouchers): array
    {
        // sort the vouchers alphabetically by its label
        uasort($vouchers, static function (Voucher $voucher1, Voucher$voucher2) {
            return $voucher1->getLabel() <=> $voucher2->getLabel();
        });

        foreach ($vouchers as $voucher) {
            // identify in which criterion the voucher belongs to by matching them,
            // criteria are arranged by priority at this point
            foreach ($this->criteria->getIterator() as $criterion) {
                if ($criterion->matches($voucher, $user)) {
                    // store the voucher into the criterion
                    $criterion->add($voucher);
                    // when a match is found, move on to the next voucher
                    continue 2;
                }
            }
        }

        return array_merge(...$this->criteria->getValues());
    }

    public function sort(User $user, array $vouchers): array
    {
        $this->user = $user;

        $noPointsRequired = [];
        $noSku = [];
        $sufficientPoints = [];
        $outOfStock = [];
        $insufficientPoints = [];

        foreach ($vouchers as $voucher) {
            if ($this->isNoPointsRequired($voucher)) {
                $noPointsRequired[] = $voucher;
            }

            if ($this->isSufficientPoints($voucher)) {
                if ($this->isNoSKUFound($voucher)) {
                    $noSku[] = $voucher;
                }

                // @todo: Add Out of stock voucher
                $sufficientPoints[] = $voucher;
            }

            if (!$this->isSufficientPoints($voucher)) {
                $insufficientPoints[] = $voucher;
            }
        }

        foreach ($sufficientPoints as $key => $sufficientPointVoucher) {
            foreach ($outOfStock as $outOfStockVoucher) {
                if ($sufficientPointVoucher->getId() === $outOfStockVoucher->getId()) {
                    unset($sufficientPoints[$key]);
                }
            }

            foreach ($noSku as $noSkuVoucher) {
                if ($sufficientPointVoucher->getId() === $noSkuVoucher->getId()) {
                    unset($sufficientPoints[$key]);
                }
            }

            foreach ($noPointsRequired as $noPointsRequiredVoucher) {
                if ($sufficientPointVoucher->getId() === $noPointsRequiredVoucher->getId()) {
                    unset($sufficientPoints[$key]);
                }
            }
        }

        foreach ($noPointsRequired as $key => $noPointsRequiredVoucher) {
            foreach ($outOfStock as $outOfStockVoucher) {
                if ($noPointsRequiredVoucher->getId() === $outOfStockVoucher->getId()) {
                    unset($noPointsRequired[$key]);
                }
            }

            foreach ($noSku as $noSkuVoucher) {
                if ($noPointsRequiredVoucher->getId() === $noSkuVoucher->getId()) {
                    unset($noPointsRequired[$key]);
                }
            }
        }

        return array_merge(
            $noPointsRequired,
            $sufficientPoints,
            $noSku,
            $outOfStock,
            $insufficientPoints,
        );
    }

    private function isNoPointsRequired(Voucher $voucher): bool
    {
        return $voucher->getPointsCost() === 0;
    }

    private function isNoSKUFound(Voucher $voucher): bool
    {
        $offeredProduct = $voucher->getOfferedProduct();

        return $offeredProduct !== null && count($offeredProduct->getItems()) === 0;
    }

    private function isSufficientPoints(Voucher $voucher): bool
    {
        return $this->user->getPoints() >= $voucher->getPointsCost();
    }

    private function isOutOfStock(Voucher $voucher): bool
    {
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
        if ($offeredProduct->getType() === OfferedProduct::CATEGORY_TYPE) {
            
        }
    }
}
