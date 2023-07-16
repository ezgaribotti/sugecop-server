<?php

namespace App\Repositories\Api;

use App\Entities\Api\Product;
use App\Interfaces\Api\ProductRepositoryInterface;
use App\Repositories\Repository;

class ProductRepository extends Repository implements ProductRepositoryInterface
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function getByName(string $name)
    {
        $query = Product::query();
        $query->where('name', $name);
        return $query->first();
    }
}
