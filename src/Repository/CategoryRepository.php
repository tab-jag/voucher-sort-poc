<?php

declare(strict_types=1);

namespace App\Repository;


use App\Entity\Category;
use App\Entity\Food;

final class CategoryRepository
{
    public function findOneByExternalId($categoryId): ?Category
    {
        if ($categoryId === 'ZT201520') {
            $category = new Category();
            $category->addFood(Food::disabled('466'));
            $category->addFood(Food::disabled('468'));
            $category->addFood(Food::available('469'));
            $category->addFood(Food::disabled('476'));
        }

        return null;
    }
}
