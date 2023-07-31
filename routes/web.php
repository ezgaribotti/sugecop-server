<?php

use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/images/{imageName}', function (string $imageName) {
    ImageHelper::validateExists($imageName);
    return response()->file(ImageHelper::buildAbsolutePath($imageName));
});
