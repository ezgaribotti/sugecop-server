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
        $result = [];
        foreach ($this as $key => $value) {
            if ($value instanceof Dto) {
                $result[$key] = get_object_vars($value);

            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }
}
