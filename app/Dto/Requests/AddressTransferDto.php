<?php

namespace App\Dto\Requests;

use App\Dto\Dto;

class AddressTransferDto extends Dto
{
    protected int $customer_id;
    protected string $province;
    protected string $department;
    protected string $locality;
    protected string $street_name;
    protected int $street_number;
    protected string $postal_code;
    protected ?string $reference = null;

    public function getCustomerId(): int
    {
        return $this->customer_id;
    }
}
