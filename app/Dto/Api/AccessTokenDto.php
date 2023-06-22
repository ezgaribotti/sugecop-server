<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class AccessTokenDto extends Dto
{
    protected string $access_token;
    protected OperatorDto $operator;

    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    public function getOperator(): OperatorDto
    {
        return $this->operator;
    }

    public function setOperator(OperatorDto $operator): void
    {
        $this->operator = $operator;
    }
}
