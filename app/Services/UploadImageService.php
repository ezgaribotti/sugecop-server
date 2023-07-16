<?php

namespace App\Services;

use App\Dto\Api\UploadedFileDto;
use App\Helpers\ImageHelper;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Http\UploadedFile;

class UploadImageService
{
    public function save(UploadedFile $image): UploadedFileDto
    {
        $extension = $image->getClientOriginalExtension();
        $fileName = Str::random(6) . now()->getTimestamp() . chr(46) . $extension;

        ImageHelper::validateExists($fileName);

        $path = ImageHelper::getPath();
        $image->storeAs($path, $fileName);

        $result = new UploadedFileDto();
        $result->setFileName($fileName);
        $result->setExtension($extension);
        $result->setPath($path);
        return $result;
    }
}
