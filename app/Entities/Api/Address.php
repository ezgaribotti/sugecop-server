<?php

namespace App\Entities\Api;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Entity
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'state',
        'city',
        'street_address',
        'postal_code',
        'reference',
    ];
}
