<?php

namespace App\Interfaces\Api;

use App\Interfaces\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getByName(string $name);
}
