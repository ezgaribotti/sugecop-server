<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class CustomerDto extends Dto
{
    protected int $id;
    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected string $phone_number;
    protected ?GenderDto $gender;
    protected string $created_at;
    protected string $updated_at;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setGender(?GenderDto $gender): void
    {
        $this->gender = $gender;
    }
}
