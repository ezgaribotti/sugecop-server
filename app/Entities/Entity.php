<?php

namespace App\Entities;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

abstract class Entity extends Model
{
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }
}
