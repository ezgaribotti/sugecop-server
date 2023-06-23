<?php

namespace App\Interfaces\Api;

use App\Interfaces\RepositoryInterface;

interface OperatorRepositoryInterface extends RepositoryInterface
{
    public function getByUsernameOrInternalCode(string $username);

    public function getByEmail(string $email);
}
