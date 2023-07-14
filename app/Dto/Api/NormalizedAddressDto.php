<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class NormalizedAddressDto extends Dto
{
    protected string $id;
    protected string $name;

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
