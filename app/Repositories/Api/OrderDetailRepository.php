<?php

namespace App\Repositories\Api;

use App\Entities\Api\OrderDetail;
use App\Interfaces\Api\OrderDetailRepositoryInterface;
use App\Repositories\Repository;

class OrderDetailRepository extends Repository implements OrderDetailRepositoryInterface
{
    public function __construct(OrderDetail $orderDetail)
    {
        parent::__construct($orderDetail);
    }

    public function getByOrderId(int $orderId)
    {
        $relations = ['product'];

        $query = OrderDetail::query();
        $query->where('order_id', $orderId);
        $query->with($relations);
        return $query->get();
    }
}
