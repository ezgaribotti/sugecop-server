<?php

namespace App\Dto\Requests;

use App\Dto\Dto;

class ProductTransferDto extends Dto
{
    protected string $name;
    protected string $image_name;
    protected float $unit_price;
    protected int $category_id;
    protected int $active;
    protected int $stock;
    protected ?string $description = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function getImageName(): string
    {
        return $this->image_name;
    }
}
