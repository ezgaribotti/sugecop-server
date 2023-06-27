<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GenderService;

class GenderController extends Controller
{
    protected $genderService;

    public function __construct(GenderService $genderService)
    {
        $this->genderService = $genderService;
    }

    public function index()
    {
        return response()->success(
            $this->genderService->getAll()
        );
    }
}
