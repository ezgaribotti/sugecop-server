<?php

namespace App\Dto\Requests;

use App\Dto\Dto;

class NormalizeAddressTransferDto extends Dto
{
    protected int $type;
    protected ?array $parameters = [];

    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    public function setParameters(?array $parameters): void
    {
        $this->parameters = $parameters;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }
}
