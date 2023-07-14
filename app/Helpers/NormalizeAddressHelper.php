<?php

namespace App\Helpers;

use App\Dto\Api\NormalizedAddressDto;
use App\Dto\Requests\NormalizeAddressTransferDto;
use App\Exceptions\Api\MessageException;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class NormalizeAddressHelper
{
    const TERRITORIAL_DIVISIONS = ['provincias', 'departamentos', 'localidades', 'calles'];

    const KEYS = ['nombre', 'id'];

    public static function sendHttp(NormalizeAddressTransferDto $data): Collection
    {
        $url = config('services.georef_api.url');
        $type = self::TERRITORIAL_DIVISIONS[$data->getType()];
        $response = Http::get($url . $type, $data->getParameters());

        if ($response->status() !== 200) {

            $message = 'Ocurrió un problema al normalizar los datos geográficos.';

            throw new MessageException($message, [], 400);
        }

        $addresses = $response->json()[$type];
        $result = [];
        foreach ($addresses as $address) {
            $normalized = new NormalizedAddressDto($address);
            $normalized->setName($address[self::KEYS[0]]);
            $result[] = $normalized;
        }
        return collect($result);
    }

    public static function search(int $type, string $id): string
    {
        $configuration = new NormalizeAddressTransferDto();
        $configuration->setType($type);
        $configuration->setParameters([
            self::KEYS[1] => $id
        ]);

        $name = $id;
        try {
            $result = self::sendHttp($configuration)->first();
            if ($result instanceof NormalizedAddressDto) $name = $result->getName();

        } catch (Exception $exception) {}

        return $name;
    }
}
