<?php

namespace App\Repositories\Api;

use App\Entities\Api\OrderStatus;
use App\Interfaces\Api\OrderStatusRepositoryInterface;
use App\Repositories\Repository;

class OrderStatusRepository extends Repository implements OrderStatusRepositoryInterface
{
    public function __construct(OrderStatus $orderStatus)
    {
        parent::__construct($orderStatus);
    }

    public function getByName(string $name)
    {
        $query = OrderStatus::query();
        $query->where('name', $name);
        return $query->firstOrFail();
    }
}
