<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GenderService;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    protected $genderService;

    public function __construct(GenderService $genderService)
    {
        $this->genderService = $genderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->success(
            $this->genderService->getAll()
        );
    }
}
