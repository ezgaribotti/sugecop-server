<?php

namespace App\Interfaces\Api;

use App\Interfaces\RepositoryInterface;

interface IdentificationTypeRepositoryInterface extends RepositoryInterface
{
    public function getByName(string $name);
}
