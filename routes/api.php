<?php

use App\Http\Controllers\Api\OperatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(OperatorController::class)->group(function () {
    Route::get('/operators', 'index');
    Route::post('/operators', 'store');
    Route::get('/operators/{id}', 'show');
    Route::put('/operators/{id}', 'update');
    Route::delete('/operators/{id}', 'destroy');
});
