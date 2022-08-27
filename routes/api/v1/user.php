<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/user/register', [UserController::class, 'registerUser'])->name('register');
Route::post('/user/login', [UserController::class, 'loginUser'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/all', [UserController::class, 'viewAllUsers'])->name('all');
    Route::post('/user/logout', [UserController::class, 'logoutUser'])->name('logout');
});
