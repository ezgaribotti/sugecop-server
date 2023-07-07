<?php

namespace App\Helpers;

use App\Dto\Api\AddressNormalizationDto;
use App\Dto\Requests\AddressNormalizationTransferDto;
use App\Exceptions\Api\MessageException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class AddressNormalizationHelper
{
    const TERRITORIAL_DIVISIONS = ['provincias', 'departamentos', 'localidades', 'calles'];

    const KEYS = ['nombre'];

    public static function sendHttp(AddressNormalizationTransferDto $data): Collection
    {
        $url = config('services.georef_api.url');
        $division = self::TERRITORIAL_DIVISIONS;
        $division = $division[$data->getStep() - 1];
        $response = Http::get($url . $division, $data->getParameters());

        if ($response->status() !== 200) {

            $message = 'Ocurrió un problema al normalizar los datos geográficos.';

            throw new MessageException($message, [], 400);
        }

        $addresses = $response->json()[$division];
        $keys = self::KEYS;
        $unique = array_unique(array_column($addresses, reset($keys)));
        $result = [];

        foreach ($unique as $key => $value) {
            foreach ($addresses as $id => $address) {
                if ($key === $id) {
                    $temporary = new AddressNormalizationDto($address);
                    $temporary->setName($value);
                    $result[] = $temporary;
                }
            }
        }
        return collect($result);
    }
}
