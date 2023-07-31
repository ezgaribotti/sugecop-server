<?php

namespace App\Interfaces\Api;

use App\Interfaces\RepositoryInterface;

interface OrderDetailRepositoryInterface extends RepositoryInterface
{
    public function getByOrderId(int $orderId);
}
