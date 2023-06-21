<?php

namespace App\Exceptions\Api;

use App\Helpers\MessageHelper;
use Exception;
use Throwable;

class CustomMessageException extends Exception
{
    public function __construct(string $message, array $replace = [], ?Throwable $previous = null)
    {
        $message = MessageHelper::build($message, $replace);

        parent::__construct($message, 0, $previous);
    }
}
