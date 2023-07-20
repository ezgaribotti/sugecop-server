<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class OrderListDto extends Dto
{
    protected int $id;
    protected string $order_number;
    protected int $order_status_id;
    protected int $customer_id;
    protected string $created_at;
    protected string $updated_at;
}
