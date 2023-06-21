<?php

namespace App\Repositories\Api;

use App\Entities\Api\Operator;
use App\Interfaces\Api\OperatorRepositoryInterface;
use App\Repositories\Repository;

class OperatorRepository extends Repository implements OperatorRepositoryInterface
{
    public function __construct(Operator $operator)
    {
        parent::__construct($operator);
    }

    public function getByUsernameOrInternalCode(string $parameter)
    {
        $query = Operator::query();
        $query->where('username', $parameter);
        $query->orWhere('internal_code', $parameter);

        return $query->firstOrFail();
    }

    public function getByEmail(string $email)
    {
        $query = Operator::query();
        $query->where('email', $email);

        return $query->firstOrFail();
    }
}
