<?php

namespace App\Dto\Requests;

use App\Dto\Dto;

class IdentificationTransferDto extends Dto
{
    protected int $customer_id;
    protected int $identification_type_id;
    protected string $number;

    public function getCustomerId(): int
    {
        return $this->customer_id;
    }

    public function setCustomerId(int $customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    public function getIdentificationTypeId(): int
    {
        return $this->identification_type_id;
    }

    public function setIdentificationTypeId(int $identification_type_id): void
    {
        $this->identification_type_id = $identification_type_id;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }
}
