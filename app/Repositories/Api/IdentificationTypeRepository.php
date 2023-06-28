<?php

namespace App\Repositories\Api;

use App\Entities\Api\IdentificationType;
use App\Interfaces\Api\IdentificationTypeRepositoryInterface;
use App\Repositories\Repository;

class IdentificationTypeRepository extends Repository implements IdentificationTypeRepositoryInterface
{
    public function __construct(IdentificationType $identificationType)
    {
        parent::__construct($identificationType);
    }

    public function getByName(string $name)
    {
        $query = IdentificationType::query();
        $query->where('name', $name);

        return $query->firstOrFail();
    }
}
