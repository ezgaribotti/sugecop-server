<?php

namespace App\Entities\Api;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Entity
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'gender_id',
    ];

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }
}
