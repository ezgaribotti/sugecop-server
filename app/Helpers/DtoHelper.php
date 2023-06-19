<?php

namespace App\Helpers;

use App\Dto\Dto;
use App\Entities\Entity;
use Exception;
use Illuminate\Support\Collection;

class DtoHelper
{
    public static function validateData(Dto|Collection $data): array
    {
        if ($data instanceof Collection) {
            $result = [];
            foreach ($data as $key => $value) {
                if (!$value instanceof Dto) {
                    $message = 'El objeto de transferencia de datos en el listado de respuesta no es válido.';

                    throw new Exception($message);
                }
                $result[] = $value->toArray();
            }
            return $result;
        }

        return $data->toArray();
    }

    public static function collectData(Collection $data, Dto $dto): Collection
    {
        $result = [];
        foreach ($data as $key => $value) {
            if ($value instanceof Entity) {
                $result[] = new $dto($value->toArray());
            }
        }
        return collect($result);
    }
}
