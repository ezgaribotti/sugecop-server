<?php

namespace App\Entities\Api;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Entity
{
    use HasFactory;

    protected $fillable = [
        'name',
        'active',
    ];
}
