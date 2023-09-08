<?php

use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\SendMessage\SendMessageConroller;
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

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');

/* protected routes */
Route::middleware('auth')->group(function () {

//    Route::group([
//        'prefix' => '2fac'
//    ], function () {
//        Route::post('enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
//        Route::get('show', [IndexController::class, 'twoFactorAuth'])->name('2fa.show');
//        Route::post('verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');
//    });
    Route::post('/send_message', SendMessageConroller::class)->name('send_message');
});

Route::get('/verify/{id}/{hash}', VerificationController::class)->name('verification.verify');
