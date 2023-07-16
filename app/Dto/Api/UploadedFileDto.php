<?php

namespace App\Dto\Api;

use App\Dto\Dto;

class UploadedFileDto extends Dto
{
    protected string $file_name;
    protected string $extension;
    protected string $path;

    public function setFileName(string $file_name): void
    {
        $this->file_name = $file_name;
    }

    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }
}
