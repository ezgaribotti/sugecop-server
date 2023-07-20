<?php

namespace App\Entities\Api;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Entity
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'order_status_id',
        'customer_id',
        'identification_id',
        'shipping_address_id',
        'total_amount',
    ];

    public function orderStatus(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function identification(): BelongsTo
    {
        return $this->belongsTo(Identification::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
