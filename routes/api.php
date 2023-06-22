<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OperatorController;
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

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/operator-profile', 'operatorProfile');
        Route::get('/logout', 'logout');
    });
});

Route::controller(OperatorController::class)->group(function () {
    Route::get('/operators', 'index');
    Route::post('/operators', 'store');
    Route::get('/operators/{id}', 'show');
    Route::put('/operators/{id}', 'update');
    Route::delete('/operators/{id}', 'destroy');
});
