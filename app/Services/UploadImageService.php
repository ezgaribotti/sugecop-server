<?php

namespace App\Services;

use App\Dto\Api\UploadedFileDto;
use App\Exceptions\Api\MessageException;
use App\Helpers\ImageHelper;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadImageService
{
    public function save(UploadedFile $image): UploadedFileDto
    {
        $extension = $image->getClientOriginalExtension();
        $currentTimestamp = now()->getTimestamp();
        $imageName = substr($currentTimestamp, 0, 8) . Str::random(16) . substr($currentTimestamp, 8) . chr(46) . $extension;

        try {
            ImageHelper::validateExists($imageName);
        } catch (MessageException $exception) {
            $image->storeAs(ImageHelper::STORAGE_PATH, $imageName);
            $result = new UploadedFileDto();
            $result->setFileName($imageName);
            $result->setExtension($extension);
            return $result;
        }

        throw new Exception();
    }
}
