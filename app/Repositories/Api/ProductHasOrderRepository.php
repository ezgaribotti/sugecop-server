<?php

namespace App\Repositories\Api;

use App\Entities\Api\ProductHasOrder;
use App\Interfaces\Api\ProductHasOrderRepositoryInterface;
use App\Repositories\Repository;

class ProductHasOrderRepository extends Repository implements ProductHasOrderRepositoryInterface
{
    public function __construct(ProductHasOrder $productHasOrder)
    {
        parent::__construct($productHasOrder);
    }

    public function getByOrderId(int $orderId)
    {
        $relations = ['product'];

        $query = ProductHasOrder::query();
        $query->where('order_id', $orderId);
        $query->with($relations);
        return $query->get();
    }
}
