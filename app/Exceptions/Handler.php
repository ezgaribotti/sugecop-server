<?php

namespace App\Exceptions;

use App\Exceptions\Api\CustomMessageException;
use App\Helpers\MessageHelper;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (ValidationException $exception) {
            return response()->error($exception->getMessage(), 422);
        });

        $this->renderable(function (NotFoundHttpException $exception) {
            $previous = $exception->getPrevious();

            if ($previous instanceof ModelNotFoundException) {
                $ids = $previous->getIds();
                $id = reset($ids);

                $message = 'No se encontraron resultados al buscar por el id 0.';

                $message = MessageHelper::build($message, [$id]);

                return response()->error($message, 404);
            }
            return response()->error($exception->getMessage(), 404);
        });

        $this->renderable(function (CustomMessageException $exception) {
            return response()->error($exception->getMessage());
        });

        $this->renderable(function (Exception $exception) {
            return response()->error($exception->getMessage());
        });
    }
}
