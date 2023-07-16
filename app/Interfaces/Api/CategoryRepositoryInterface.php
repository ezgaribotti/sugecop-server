<?php

namespace App\Interfaces\Api;

use App\Interfaces\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getByName(string $name);
}
