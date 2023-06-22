<?php

namespace App\Dto\Requests;

use App\Dto\Dto;

class CredentialTransferDto extends Dto
{
    protected string $username;
    protected mixed $password;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): mixed
    {
        return $this->password;
    }

    public function setPassword(mixed $password): void
    {
        $this->password = $password;
    }
}
