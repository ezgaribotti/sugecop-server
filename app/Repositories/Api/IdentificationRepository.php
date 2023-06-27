<?php

namespace App\Repositories\Api;

use App\Entities\Api\Identification;
use App\Interfaces\Api\IdentificationRepositoryInterface;
use App\Repositories\Repository;

class IdentificationRepository extends Repository implements IdentificationRepositoryInterface
{
    public function __construct(Identification $identification)
    {
        parent::__construct($identification);
    }

    public function validateExistence(int $identificationTypeId, string $number)
    {
        $query = Identification::query();
        $query->where('identification_type_id', $identificationTypeId);
        $query->where('number', $number);

        return $query->firstOrFail();
    }

    public function getByCustomerId(int $customerId)
    {
        $relations = ['identificationType'];

        $query = Identification::query();
        $query->where('customer_id', $customerId);
        $query->with($relations);

        return $query->get();
    }
}
