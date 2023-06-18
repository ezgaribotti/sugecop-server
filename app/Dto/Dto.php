<?php

namespace App\Dto;

use App\Entities\Entity;

abstract class Dto
{
    public function __construct(array|Entity $data = [])
    {
        if ($data instanceof Entity) {
            $data = $data->toArray();
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
