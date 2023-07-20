<?php

namespace App\Dto\Requests;

use App\Dto\Dto;

class OrderTransferDto extends Dto
{
    protected string $order_number;
    protected ?int $order_status_id = null;
    protected int $customer_id;
    protected int $identification_id;
    protected int $shipping_address_id;
    protected float $total_amount;

    public function setOrderNumber(string $order_number): void
    {
        $this->order_number = $order_number;
    }

    public function setOrderStatusId(int $order_status_id): void
    {
        $this->order_status_id = $order_status_id;
    }

    public function setTotalAmount(float $total_amount): void
    {
        $this->total_amount = $total_amount;
    }

    public function getOrderStatusId(): ?int
    {
        return $this->order_status_id;
    }
}
