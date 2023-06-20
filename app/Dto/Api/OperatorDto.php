<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class OperatorDto extends Dto
{
    protected int $id;
    protected string $full_name;
    protected string $internal_code;
    protected string $username;
    protected string $email;
    protected int $active;
    protected ?string $email_verified_at;
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

    public function getActive(): int
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
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

    public function getEmailVerifiedAt(): ?string
    {
        return $this->email_verified_at;
    }

    public function setEmailVerifiedAt(?string $email_verified_at): void
    {
        $this->email_verified_at = $email_verified_at;
    }
}
