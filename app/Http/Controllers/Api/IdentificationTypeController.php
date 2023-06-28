<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\IdentificationTypeService;

class IdentificationTypeController extends Controller
{
    protected $identificationTypeService;

    public function __construct(IdentificationTypeService $identificationTypeService)
    {
        $this->identificationTypeService = $identificationTypeService;
    }

    public function index()
    {
        return response()->success(
            $this->identificationTypeService->getAll()
        );
    }
}
