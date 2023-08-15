<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::group([
    'prefix' => '',
    'controller' => RegisterController::class
], function () {
    Route::post("/user_get", "getter")->name('user_get');
    Route::post("/get_name", "getName")->name('get_name');
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
