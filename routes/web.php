<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;

Route::get('/forget_password',[AuthController::class, 'forget_password'])->name('home.forget_password');
