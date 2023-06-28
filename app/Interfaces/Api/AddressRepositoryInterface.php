<?php

namespace App\Interfaces\Api;

use App\Interfaces\RepositoryInterface;

interface AddressRepositoryInterface extends RepositoryInterface
{
    public function getByCustomerId(int $customerId);
}
