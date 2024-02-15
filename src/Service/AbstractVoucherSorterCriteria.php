<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\Criteria\CriterionInterface;

abstract class AbstractVoucherSorterCriteria
{
    protected array $criteria = [];

    public function __construct(iterable $criteria) {
        $this->setCriteria(...$criteria);
    }

    public function setCriteria(CriterionInterface ...$criteria): VoucherSorterCriteriaInterface
    {
        // always arrange the criteria based on the position value
        uasort($criteria, static function (
            CriterionInterface $criterion1,
            CriterionInterface $criterion2,
        ) {
            return $criterion1->getPosition() <=> $criterion2->getPosition();
        });

        $this->criteria = $criteria;

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
