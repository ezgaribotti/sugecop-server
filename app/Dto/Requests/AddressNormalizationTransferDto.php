<?php

namespace App\Dto\Requests;

use App\Dto\Dto;

class AddressNormalizationTransferDto extends Dto
{
    protected int $step;
    protected ?array $parameters = [];

    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    public function setParameters(?array $parameters): void
    {
        $this->parameters = $parameters;
    }

    public function getStep(): int
    {
        return $this->step;
    }
}
