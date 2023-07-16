<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class ProductListDto extends Dto
{
    protected int $id;
    protected string $name;
    protected float $unit_price;
    protected int $active;
    protected int $stock;
    protected string $created_at;
    protected string $updated_at;
}
