<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\FoodPos;

final class FoodRepository
{
    public function findOneBySelector(string $id): ?FoodPos
    {
        if (in_array($id, [
            '466',
            '468',
            '469',
            '469',
        ], true)) {
            return new FoodPos($id);
        }

        return null;
    }
}
