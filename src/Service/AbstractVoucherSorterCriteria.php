<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Criteria\CriterionInterface;

abstract class AbstractVoucherSorterCriteria
{
    protected array $criteria = [];

    public function __construct(CriterionInterface ...$criteria) {
        $this->setCriteria(...$criteria);
    }

    public function setCriteria(CriterionInterface ...$criteria): VoucherSorterCriteriaInterface
    {
        // preserve the criteria arrangement based on the argument order
        foreach ($criteria as $criterion) {
            $this->criteria[$criterion->getName()] = $criterion;
        }

        return $this;
    }

    /**
     * Returns an array value of the collected items on each criterion
     * @return array
     */
    public function getValues(): array
    {
        $values = [];
        foreach ($this->criteria as $criterion) {
            $values[] = $criterion->getValues();
        }

        return $values;
    }

    /**
     * Returns the criteria iterator that has been sorted based on the priority,
     * 1 being the highest and will be placed on top
     * @return iterable
     */
    public function getIterator(): iterable
    {
        $criteria = new \ArrayObject($this->criteria);
        $criteria->uasort(static function(CriterionInterface $criterion1, CriterionInterface $criterion2) {
            return $criterion1->getPriority() <=> $criterion2->getPriority();
        });

        return $criteria->getIterator();
    }
}
