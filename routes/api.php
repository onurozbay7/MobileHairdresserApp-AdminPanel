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
        Route::get('/',[App\Http\Controllers\AuthController::class, 'me'])->name('me');
        Route::post('/logout',[App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


        Route::get('/working-hours/{workerId}/{date}',[App\Http\Controllers\front\api\indexController::class, 'getWorkingHours'])->name('getWorkingHours');
        Route::post('/createUserAdress',[App\Http\Controllers\front\api\indexController::class, 'createUserAdress'])->name('createUserAdress');
        Route::post('/createAppointment',[App\Http\Controllers\front\api\indexController::class, 'createAppointment'])->name('createAppointment');
        Route::get('/getUserAdress',[App\Http\Controllers\front\api\indexController::class, 'getUserAdress'])->name('getUserAdress');
        Route::get('/getReelTimeAppointment',[App\Http\Controllers\front\api\indexController::class, 'getReelTimeAppointment'])->name('getReelTimeAppointment');
        Route::post('/deleteUserAdress/{id}',[App\Http\Controllers\front\api\indexController::class, 'deleteUserAdress'])->name('deleteUserAdress');
        Route::get('/getWorkerProfile/{il?}',[App\Http\Controllers\front\api\indexController::class, 'getWorkerProfile'])->name('getWorkerProfile');
        Route::get('/getWorker/{id?}',[App\Http\Controllers\front\api\indexController::class, 'getWorker'])->name('getWorker');
        Route::get('/getServiceList/{id?}',[App\Http\Controllers\front\api\indexController::class, 'getServiceList'])->name('getServiceList');
    });



});





