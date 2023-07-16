<?php

namespace App\Services;

use App\Dto\Api\UploadedFileDto;
use App\Exceptions\Api\MessageException;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadImageService
{
    public function save(UploadedFile $image): UploadedFileDto
    {
        $path = config('filesystems.storages.image');

        $extension = $image->getClientOriginalExtension();
        $fileName = Str::random(6) . now()->getTimestamp() . chr(46) . $extension;

        $fullPath = $path . chr(47) . $fileName;

        if (Storage::exists($fullPath)) {

            $message = 'Ocurrió un error al guardar la imagen, intente nuevamente.';

            throw new MessageException($message);
        }

        $image->storeAs($path, $fileName);

        $result = new UploadedFileDto();
        $result->setFileName($fileName);
        $result->setExtension($extension);
        $result->setPath($path);
        return $result;
    }
}
