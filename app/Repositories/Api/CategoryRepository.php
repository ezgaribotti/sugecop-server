<?php

namespace App\Repositories\Api;

use App\Entities\Api\Category;
use App\Interfaces\Api\CategoryRepositoryInterface;
use App\Repositories\Repository;

class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function getByName(string $name)
    {
        $query = Category::query();
        $query->where('name', $name);
        return $query->firstOrFail();
    }
}
