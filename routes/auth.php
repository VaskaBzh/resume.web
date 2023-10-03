<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResendVerifyEmailController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;

Auth::routes(['logout' => false, 'reset' => false, 'login' => false]);

Route::post('/login', [LoginController::class, 'login'])
    ->middleware('verified');

Route::group(['middleware' => ['signed', 'throttle:6,1']], function () {
    Route::get('/verify/{id}/{hash}', VerificationController::class)
        ->name('verification.verify');
    Route::get('/password/reset/verify/{id}/{hash}', [ResetPasswordController::class, 'verifyPasswordChange'])
        ->name('password.reset.verify');
});

Route::group(['middleware' => 'throttle:3,1'], function () {
    Route::post('/email/verify', ResendVerifyEmailController::class)
        ->name('resend-verify-email');
    Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail']);
});

Route::put('/password/change/{user}', [ResetPasswordController::class, 'changePassword']);
