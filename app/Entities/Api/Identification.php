<?php

namespace App\Entities\Api;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Identification extends Entity
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'identification_type_id',
        'number',
    ];

    public function identificationType(): BelongsTo
    {
        return $this->belongsTo(IdentificationType::class);
    }
}
