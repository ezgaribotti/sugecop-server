<?php

namespace App\Interfaces\Api;

use App\Interfaces\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{
    public function getByOrderNumber(string $orderNumber);
}
