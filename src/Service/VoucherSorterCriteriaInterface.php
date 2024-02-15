<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Criteria\CriterionInterface;

interface VoucherSorterCriteriaInterface
{
    public function setCriteria(CriterionInterface ...$criteria): VoucherSorterCriteriaInterface;

    public function getValues(): array;

    public function getIterator(): iterable;
}
