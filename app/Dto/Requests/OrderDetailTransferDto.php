<?php

namespace App\Dto\Requests;

use App\Dto\Dto;

class OrderDetailTransferDto extends Dto
{
    protected int $product_id;
    protected int $order_id;
    protected int $quantity;
    protected float $fixed_price;

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setFixedPrice(float $fixed_price): void
    {
        $this->fixed_price = $fixed_price;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getOrderId(): int
    {
        return $this->order_id;
    }
}
