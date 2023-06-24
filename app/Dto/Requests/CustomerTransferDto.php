<?php

namespace App\Dto\Requests;

use App\Dto\Dto;

class CustomerTransferDto extends Dto
{
    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected string $phone_number;
    protected int $gender_id;

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    public function getGenderId(): int
    {
        return $this->gender_id;
    }

    public function setGenderId(int $gender_id): void
    {
        $this->gender_id = $gender_id;
    }
}
