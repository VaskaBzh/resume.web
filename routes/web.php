<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
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

Route::controller(IndexController::class)
    ->middleware('guest')
    ->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/complexity', 'complexity')->name('complexity');
        Route::get('/help', 'help')->name('help');
        Route::get('/about', 'about')->name('about');
    });

Route::controller(AuthController::class)
    ->group(function () {
        Route::post('/login', 'login')->name('login')->middleware('guest');
        Route::delete('/logout', 'logout')->name('logout');
    });

Route::resource('users', AuthController::class);
