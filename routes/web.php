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




Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['namespace'=>'front','middleware'=>['auth']],function (){
    Route::group(['namespace'=>'profil','as'=>'profil.', 'prefix'=>'profil'], function (){
    Route::group(['namespace'=>'profil','as'=>'profil.', 'prefix'=>'profil'], function (){

        Route::get('/',[App\Http\Controllers\front\profil\indexController::class, 'index'])->name('index');
        Route::post('/',[App\Http\Controllers\front\profil\indexController::class, 'update'])->name('update');

    });


    Route::group(['namespace'=>'logger','as'=>'logger.', 'prefix'=>'logger'], function (){

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
    });

    });
});
