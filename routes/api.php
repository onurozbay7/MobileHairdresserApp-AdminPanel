<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('user')->group( function () {
    Route::post('/login',[App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/register',[App\Http\Controllers\AuthController::class, 'register'])->name('register');

    Route::group(['middleware' => ['auth:sanctum']], function () {
        // our routes to be protected will go in here
        Route::get('/',[App\Http\Controllers\AuthController::class, 'user'])->name('user');
        Route::post('/logout',[App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    });

});
