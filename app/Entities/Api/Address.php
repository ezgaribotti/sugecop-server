<?php

namespace App\Entities\Api;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Entity
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'province',
        'department',
        'locality',
        'street_name',
        'street_number',
        'postal_code',
        'reference',
    ];
}
