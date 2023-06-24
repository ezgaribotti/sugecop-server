<?php

namespace App\Entities\Api;

use App\Entities\NoTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gender extends NoTimestamp
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
