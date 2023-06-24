<?php

namespace App\Interfaces\Api;

use App\Interfaces\RepositoryInterface;

interface GenderRepositoryInterface extends RepositoryInterface
{
    public function getByName(string $name);
}
