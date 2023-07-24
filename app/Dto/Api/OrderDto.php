<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class OrderDto extends Dto
{
    protected int $id;
    protected string $order_number;
    protected ?OrderStatusDto $order_status;
    protected int $customer_id;
    protected int $identification_id;
    protected int $shipping_address_id;
    protected float $total_amount;
    protected string $created_at;
    protected string $updated_at;

    public function setOrderStatus(?OrderStatusDto $order_status): void
    {
        $this->order_status = $order_status;
    }

    public function setTotalAmount(float $total_amount): void
    {
        $this->total_amount = $total_amount;
    }

    public function getTotalAmount(): float
    {
        return $this->total_amount;
    }
}
