<?php

namespace App\Entities\Api;

use App\Entities\NoTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductHasOrder extends NoTimestamp
{
    use HasFactory;

    protected $table = 'product_has_order';

    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
        'fixed_price',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
