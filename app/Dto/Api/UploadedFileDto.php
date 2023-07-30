<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class UploadedFileDto extends Dto
{
    protected string $file_name;
    protected string $extension;

    public function setFileName(string $file_name): void
    {
        $this->file_name = $file_name;
    }

    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }
}
