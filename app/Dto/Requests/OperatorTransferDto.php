<?php

namespace App\Dto\Requests;

use App\Dto\Dto;

class OperatorTransferDto extends Dto
{
    protected string $full_name;
    protected string $internal_code;
    protected string $username;
    protected string $email;
    protected ?string $password = null;
    protected int $active;

    public function getFullName(): string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): void
    {
        $this->full_name = $full_name;
    }

    public function getInternalCode(): string
    {
        return $this->internal_code;
    }

    public function setInternalCode(string $internal_code): void
    {
        $this->internal_code = $internal_code;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getActive(): int
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }
}
