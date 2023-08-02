<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group([
    'prefix' => '',
    'controller' => IndexController::class
], function () {
    Route::get('/', 'index')->name('home');
    Route::get('/help', 'help')->name('help');
    Route::get('/hosting', 'hosting')->name('hosting');
    Route::get('/registration', 'registration')->name('registration');
    Route::get('/login', 'login')->name('login');
});

Route::group([
    'prefix' => '',
    'controller' => RegisterController::class
], function () {
    Route::post("/user_get", "getter")->name('user_get');
    Route::post("/get_name", "getName")->name('get_name');
    Route::get('/email/verify/{id}/{hash}',  'verify')->name('verification.verify');
});

Route::group([
    'prefix' => '',
    'controller' => LocationController::class
], function () {
    Route::post("/get_location", "get_location")->name('get_location');
    Route::post("/set_location", "set_location")->name('set_location');
});

Route::group([
    'prefix' => '',
    'controller' => LoginController::class
], function () {
    Route::post("/reverify", "verify")->name('reverify');
});

Route::group([
    'prefix' => '',
    'controller' => VerificationController::class
], function () {
    Route::get('/email/verify', 'show')->name('verification.notice');
    Route::get('/email/resend', 'resend')->name('verification.resend');
});
