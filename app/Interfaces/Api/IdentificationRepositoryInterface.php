<?php

namespace App\Interfaces\Api;

use App\Interfaces\RepositoryInterface;

interface IdentificationRepositoryInterface extends RepositoryInterface
{
    public function validateExistence(int $identificationTypeId, string $number);

    public function getByCustomerId(int $customerId);
}
