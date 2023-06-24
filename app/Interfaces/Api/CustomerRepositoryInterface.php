<?php

namespace App\Interfaces\Api;

use App\Interfaces\RepositoryInterface;

interface CustomerRepositoryInterface extends RepositoryInterface
{
    public function getByEmail(string $email);
}
