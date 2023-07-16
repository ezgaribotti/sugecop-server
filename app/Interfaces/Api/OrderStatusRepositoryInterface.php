<?php

namespace App\Interfaces\Api;

use App\Interfaces\RepositoryInterface;

interface OrderStatusRepositoryInterface extends RepositoryInterface
{
    public function getByName(string $name);
}
