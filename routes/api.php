<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\NormalizeAddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\GenderController;
use App\Http\Controllers\Api\IdentificationController;
use App\Http\Controllers\Api\IdentificationTypeController;
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

Route::get('/genders', [GenderController::class, 'index']);

Route::controller(CustomerController::class)->group(function () {
    Route::get('/customers', 'index');
    Route::post('/customers', 'store');
    Route::get('/customers/{id}', 'show');
    Route::put('/customers/{id}', 'update');
    Route::delete('/customers/{id}', 'destroy');
});

Route::get('/identification-types', [IdentificationTypeController::class, 'index']);

Route::controller(IdentificationController::class)->group(function () {
    Route::get('/identifications', 'index');
    Route::post('/identifications', 'store');
    Route::delete('/identifications/{id}', 'destroy');
});

Route::controller(AddressController::class)->group(function () {
    Route::get('/addresses', 'index');
    Route::post('/addresses', 'store');
    Route::delete('/addresses/{id}', 'destroy');
});

Route::get('/normalize-addresses', [NormalizeAddressController::class, 'index']);
