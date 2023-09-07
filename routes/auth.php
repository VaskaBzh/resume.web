<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::group([
    'prefix' => '',
    'controller' => LoginController::class
], function () {
    Route::post("/reverify", "reVerify")->name('reverify');
});
