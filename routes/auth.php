<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Account\PasswordChangeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResendVerifyEmailController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;

Auth::routes(['logout' => false, 'reset' => false, 'login' => false]);

Route::post('/login', [LoginController::class, 'login'])
    ->middleware('two-factor');
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth:sanctum')
    ->name('logout');

Route::group(['middleware' => ['signed', 'throttle:6,1']], function () {
    Route::get('/verify/{id}/{hash}', VerificationController::class)
        ->name('verification.verify');
});

Route::group(['middleware' => 'throttle:3,1'], function () {
    Route::post('/email/verify', ResendVerifyEmailController::class)
        ->name('resend-verify-email');
});

Route::group([
    'prefix' => 'password',
    'middleware' => 'throttle:6,1'
], function () {
    Route::put('/restore/{user}', [ResetPasswordController::class, 'changePassword']);
    Route::post('/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::get('/reset/verify/{id}/{hash}', [ResetPasswordController::class, 'verifyPasswordReset'])
        ->middleware('signed')
        ->name('password.reset.verify');
    Route::put('/change/{user}', PasswordChangeController::class)
        ->middleware('auth:sanctum');
});

Route::group([
    'prefix' => '2fac',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/qrcode/{user}', [TwoFactorController::class, 'qrCode'])->name('2fa.qrcode');
    Route::put('/enable/{user}', [TwoFactorController::class, 'enable'])->name('2fa.enable');
    Route::put('/disable/{user}', [TwoFactorController::class, 'disable'])->name('2fa.verify');
});
