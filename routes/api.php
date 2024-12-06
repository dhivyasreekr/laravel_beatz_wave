<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


use App\Http\Controllers\api\v2\AuthController;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);



Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::get('/user', [AuthController::class, 'getUser']);

    Route::post('/upload-profile-pic', [AuthController::class, 'upload']);

    Route::post('/update-profile', [AuthController::class, 'updateProfile']);

    Route::post('/logout', [AuthController::class, 'logout']);

});


use App\Http\Controllers\api\v2\GenreController;
use App\Http\Controllers\api\v2\BrandController;


Route::get('/genres', [GenreController::class, 'index']);
Route::get('/brands', [BrandController::class, 'index']);


