<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class AddressNormalizationDto extends Dto
{
    protected int $id;
    protected string $name;

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
