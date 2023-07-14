<?php

namespace App\Entities\Api;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Entity
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_name',
        'unit_price',
        'category_id',
        'active',
        'stock',
        'description',
    ];
}
