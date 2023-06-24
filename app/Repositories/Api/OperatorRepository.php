<?php

namespace App\Repositories\Api;

use App\Entities\Api\Operator;
use App\Exceptions\Api\MessageException;
use App\Interfaces\Api\OperatorRepositoryInterface;
use App\Repositories\Repository;
use Exception;

class OperatorRepository extends Repository implements OperatorRepositoryInterface
{
    public function __construct(Operator $operator)
    {
        parent::__construct($operator);
    }

    public function getByUsernameOrInternalCode(string $username)
    {
        $query = Operator::query();
        $query->where('username', $username);
        $query->orWhere('internal_code', $username);

        try {
            return $query->firstOrFail();

        } catch (Exception $exception) {

            $message = 'No se encontró un operador con nombre de usuario o código interno 0.';

            throw new MessageException($message, [$username], 404);
        }
    }

    public function getByEmail(string $email)
    {
        $query = Operator::query();
        $query->where('email', $email);

        try {
            return $query->firstOrFail();

        } catch (Exception $exception) {

            $message = 'No se encontró un operador con correo electrónico 0.';

            throw new MessageException($message, [$email], 404);
        }
    }
}
