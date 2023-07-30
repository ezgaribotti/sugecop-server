<?php

namespace App\Helpers;

use App\Exceptions\Api\MessageException;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    const STORAGE_PATH = 'images';

    public static function buildPath(string $imageName): string
    {
        return self::STORAGE_PATH . chr(47) . $imageName;
    }

    public static function buildAbsolutePath(string $imageName): string
    {
        $root = config('filesystems.disks.local.root');
        return $root . chr(47) . self::buildPath($imageName);
    }

    public static function validateExists(string $imageName): void
    {
        if (!Storage::exists(self::buildPath($imageName))) {

            $message = 'Imagen no encontrada.';

            throw new MessageException($message, [], 404);
        }
    }
}
