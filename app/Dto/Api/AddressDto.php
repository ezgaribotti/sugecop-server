<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class AddressDto extends Dto
{
    protected int $id;
    protected int $customer_id;
    protected string $province;
    protected string $department;
    protected string $locality;
    protected string $street_name;
    protected int $street_number;
    protected string $postal_code;
    protected ?string $reference = null;
    protected string $created_at;
    protected string $updated_at;

    public function getProvince(): string
    {
        return $this->province;
    }

    public function setProvince(string $province): void
    {
        $this->province = $province;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function setDepartment(string $department): void
    {
        $this->department = $department;
    }

    public function getLocality(): string
    {
        return $this->locality;
    }

    public function setLocality(string $locality): void
    {
        $this->locality = $locality;
    }

    public function getStreetName(): string
    {
        return $this->street_name;
    }

    public function setStreetName(string $street_name): void
    {
        $this->street_name = $street_name;
    }
}
