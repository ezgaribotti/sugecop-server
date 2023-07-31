<?php

namespace App\Repositories\Api;

use App\Entities\Api\Order;
use App\Interfaces\Api\OrderRepositoryInterface;
use App\Repositories\Repository;

class OrderRepository extends Repository implements OrderRepositoryInterface
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }

    public function getByOrderNumber(string $orderNumber)
    {
        $query = Order::query();
        $query->where('order_number', $orderNumber);
        return $query->firstOrFail();
    }
}
