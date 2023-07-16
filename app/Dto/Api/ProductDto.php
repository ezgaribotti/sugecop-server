<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class ProductDto extends Dto
{
    protected int $id;
    protected string $name;
    protected string $image_name;
    protected float $unit_price;
    protected int $category_id;
    protected int $active;
    protected int $stock;
    protected string $description;
    protected string $created_at;
    protected string $updated_at;

    public function getName(): string
    {
        return $this->name;
    }

    public function getImageName(): string
    {
        return $this->image_name;
    }
}
