<?php

namespace App\Entities\Api;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operator extends Entity
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'internal_code',
        'username',
        'email',
        'password',
        'active',
        'email_verified_at',
    ];
}
