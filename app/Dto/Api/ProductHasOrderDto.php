<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class ProductHasOrderDto extends Dto
{
    protected int $order_id;
    protected int $quantity;
    protected float $fixed_price;
    protected ?ProductDto $product;

    public function setProduct(?ProductDto $product): void
    {
        $this->product = $product;
    }
}
