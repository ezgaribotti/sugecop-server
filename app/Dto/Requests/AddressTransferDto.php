<?php

namespace App\Dto\Requests;

use App\Dto\Dto;

class AddressTransferDto extends Dto
{
    protected int $customer_id;
    protected string $state;
    protected string $city;
    protected string $street_address;
    protected string $postal_code;
    protected ?string $reference = null;

    public function getCustomerId(): int
    {
        return $this->customer_id;
    }

    public function setCustomerId(int $customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getStreetAddress(): string
    {
        return $this->street_address;
    }

    public function setStreetAddress(string $street_address): void
    {
        $this->street_address = $street_address;
    }

    public function getPostalCode(): string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): void
    {
        $this->postal_code = $postal_code;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): void
    {
        $this->reference = $reference;
    }
}
