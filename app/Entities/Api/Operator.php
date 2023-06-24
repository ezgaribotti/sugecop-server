<?php

namespace App\Entities\Api;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Operator extends Entity
{
    use HasFactory, HasApiTokens;

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
