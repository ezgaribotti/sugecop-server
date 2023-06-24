<?php

namespace App\Repositories\Api;

use App\Entities\Api\Customer;
use App\Interfaces\Api\CustomerRepositoryInterface;
use App\Repositories\Repository;

class CustomerRepository extends Repository implements CustomerRepositoryInterface
{
    public function __construct(Customer $customer)
    {
        parent::__construct($customer);
    }

    public function getByEmail(string $email)
    {
        $query = Customer::query();
        $query->where('email', $email);

        return $query->firstOrFail();
    }
}
