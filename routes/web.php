<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('login',[App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);


Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth:worker');

    Route::group(['namespace'=>'front','middleware'=>['auth:worker']],function (){

        Route::group(['namespace'=>'profil','as'=>'profil.', 'prefix'=>'profil'], function (){

            Route::get('/',[App\Http\Controllers\front\workerProfile\indexController::class, 'index'])->name('index');
            Route::post('/',[App\Http\Controllers\front\workerProfile\indexController::class, 'update'])->name('update');

        });

        Route::group(['namespace'=>'workinghours','as'=>'workinghours.', 'prefix'=>'workinghours'], function (){

            Route::get('/', [App\Http\Controllers\front\workinghours\indexController::class, 'index'])->name('index');
            Route::get('/olustur',[App\Http\Controllers\front\workinghours\indexController::class, 'create'])->name('create');
            Route::post('/olustur',[App\Http\Controllers\front\workinghours\indexController::class, 'store'])->name('store');
            Route::get('/duzenle/{id}',[App\Http\Controllers\front\workinghours\indexController::class, 'edit'])->name('edit');
            Route::post('/duzenle/{id}',[App\Http\Controllers\front\workinghours\indexController::class, 'update'])->name('update');
            Route::get('/delete/{id}',[App\Http\Controllers\front\workinghours\indexController::class, 'delete'])->name('delete');
            Route::post('/data', [App\Http\Controllers\front\workinghours\indexController::class, 'data'])->name('data');
        });





   /* Route::group(['namespace'=>'logger','as'=>'logger.', 'prefix'=>'logger'], function (){

        Route::get('/',[App\Http\Controllers\front\logger\indexController::class, 'index'])->name('index');
        Route::post('/data', [App\Http\Controllers\front\logger\indexController::class, 'data'])->name('data');

    });

    Route::group(['namespace'=>'home', 'as'=>'home.'],function (){

        Route::get('/',[App\Http\Controllers\front\home\indexController::class, 'index'])->name('index');

    });

    Route::group(['namespace'=>'musteriler','as'=>'musteriler.', 'prefix'=>'musteriler', 'middleware' => ['PermissionControl']], function (){

        Route::get('/', [App\Http\Controllers\front\musteriler\indexController::class, 'index'])->name('index');
        Route::get('/olustur',[App\Http\Controllers\front\musteriler\indexController::class, 'create'])->name('create');
        Route::post('/olustur',[App\Http\Controllers\front\musteriler\indexController::class, 'store'])->name('store');
        Route::get('/duzenle/{id}',[App\Http\Controllers\front\musteriler\indexController::class, 'edit'])->name('edit');
        Route::post('/duzenle/{id}',[App\Http\Controllers\front\musteriler\indexController::class, 'update'])->name('update');
        Route::get('/delete/{id}',[App\Http\Controllers\front\musteriler\indexController::class, 'delete'])->name('delete');
        Route::get('/cari/{id}',[App\Http\Controllers\front\musteriler\indexController::class, 'cari'])->name('cari');
        Route::post('/data', [App\Http\Controllers\front\musteriler\indexController::class, 'data'])->name('data');
    });*/


});
