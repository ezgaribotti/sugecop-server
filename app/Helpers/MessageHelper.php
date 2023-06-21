<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class MessageHelper
{
    public static function build(string $message, array $replace = []): string
    {
        foreach ($replace as $key => $value) {
            $message = Str::replace($key, $value, $message);
        }
        return $message;
    }
}
