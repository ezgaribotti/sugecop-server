<?php

namespace App\Repositories\Api;

use App\Entities\Api\Address;
use App\Interfaces\Api\AddressRepositoryInterface;
use App\Repositories\Repository;

class AddressRepository extends Repository implements AddressRepositoryInterface
{
    public function __construct(Address $address)
    {
        parent::__construct($address);
    }

    public function getByCustomerId(int $customerId)
    {
        $query = Address::query();
        $query->where('customer_id', $customerId);

        return $query->get();
    }
}
