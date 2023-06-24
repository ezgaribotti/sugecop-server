<?php

namespace App\Repositories\Api;

use App\Entities\Api\Gender;
use App\Interfaces\Api\GenderRepositoryInterface;
use App\Repositories\Repository;

class GenderRepository extends Repository implements GenderRepositoryInterface
{
    public function __construct(Gender $gender)
    {
        parent::__construct($gender);
    }

    public function getByName(string $name)
    {
        $query = Gender::query();
        $query->where('name', $name);

        return $query->firstOrFail();
    }
}
