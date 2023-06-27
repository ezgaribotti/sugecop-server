<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class IdentificationDto extends Dto
{
    protected int $id;
    protected int $customer_id;
    protected ?IdentificationTypeDto $identification_type;
    protected string $number;
    protected string $created_at;
    protected string $updated_at;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCustomerId(): int
    {
        return $this->customer_id;
    }

    public function setCustomerId(int $customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function getIdentificationType(): ?IdentificationTypeDto
    {
        return $this->identification_type;
    }

    public function setIdentificationType(?IdentificationTypeDto $identification_type): void
    {
        $this->identification_type = $identification_type;
    }
}
