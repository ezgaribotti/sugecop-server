<?php

namespace App\Interfaces\Api;

use App\Interfaces\RepositoryInterface;

interface ProductHasOrderRepositoryInterface extends RepositoryInterface
{
    public function getByOrderId(int $orderId);
}
