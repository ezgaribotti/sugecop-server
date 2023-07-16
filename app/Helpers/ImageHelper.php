<?php

namespace App\Helpers;

use App\Exceptions\Api\MessageException;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function getPath(): string
    {
        return config('filesystems.storages.image');
    }

    public static function buildPath(string $imageName): string
    {
        return self::getPath() . chr(47) . $imageName;
    }

    public static function validateExists(string $imageName): void
    {
        if (!Storage::exists(self::buildPath($imageName))) {

            $message = 'Imagen no encontrada en el almacenamiento interno.';

            throw new MessageException($message, [], 422);
        }
    }

    public static function delete(string $imageName): bool
    {
        return Storage::delete(self::buildPath($imageName));
    }
}
