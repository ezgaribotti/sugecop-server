<?php

namespace App\Entities\Api;

use App\Entities\NoTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderStatus extends NoTimestamp
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
