<?php

namespace App\Entities\Api;

use App\Entities\NoTimestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IdentificationType extends NoTimestamp
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
