<?php

namespace App\Exceptions\Api;

use App\Helpers\MessageHelper;
use Exception;
use Throwable;

class MessageException extends Exception
{
    public function __construct(string $message, ?array $replace = null, int $statusCode = 500, ?Throwable $previous = null)
    {
        $message = MessageHelper::build($message, $replace);

        parent::__construct($message, $statusCode, $previous);
    }
}
