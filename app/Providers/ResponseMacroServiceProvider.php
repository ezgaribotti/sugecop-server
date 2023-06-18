<?php

namespace App\Providers;

use App\Dto\Base\ResponseDto;
use App\Dto\Dto;
use App\Helpers\DtoHelper;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Response::macro('success', function (Dto|Collection $data = null, string $message = null) {

            if (!$message) {
                $message = 'Solicitud completada con éxito.';
            }

            $response = new ResponseDto();
            $response->setSuccess(true);
            $response->setStatusCode(200);
            $response->setMessage($message);
            if ($data) $response->setData(DtoHelper::validateData($data));

            return Response::json($response->toArray());
        });

        Response::macro('error', function (string $message = null, int $statusCode = 500) {

            if (!$message) {
                $message = 'Ocurrió un problema al procesar la solicitud.';
            }

            $response = new ResponseDto();
            $response->setSuccess(false);
            $response->setStatusCode($statusCode);
            $response->setMessage($message);

            return Response::json($response->toArray(), $statusCode);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
