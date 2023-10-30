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
use Illuminate\Support\Facades\Route;

Auth::routes([
    'logout' => false,
    'reset' => false,
    'login' => false
]);

Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login')
        ->middleware(['two-factor', 'throttle:6,1']);

    Route::post('/logout', 'logout')
        ->middleware('auth:sanctum')
        ->name('logout');
});

Route::get('/verify/{id}/{hash}', VerificationController::class)
    ->name('verification.verify')
    ->middleware('throttle:6,1')
    ->middleware('signed');

Route::post('/email/verify', ResendVerifyEmailController::class)
    ->name('resend-verify-email')
    ->middleware('throttle:3,1');

Route::group([
    'prefix' => 'password',
    'middleware' => 'throttle:6,1'
], function () {
    Route::put('/restore/{user}', [ResetPasswordController::class, 'restorePassword']);
    Route::post('/forgot', [ForgotPasswordController::class, 'sendLink']);
    Route::get('/reset/verify/{id}/{hash}', [ResetPasswordController::class, 'verifyPasswordReset'])
        ->middleware('signed')
        ->name('password.reset.verify');
    Route::put('/change/{user}', PasswordChangeController::class)
        ->name('password-change')
        ->middleware(['auth:sanctum', 'throttle:3,1']);
});

Route::group([
    'prefix' => '2fac',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/qrcode/{user}', [TwoFactorController::class, 'qrCode'])->name('2fa.qrcode');
    Route::put('/enable/{user}', [TwoFactorController::class, 'enable'])
        ->middleware('throttle:6,1')
        ->name('2fa.enable');
    Route::put('/disable/{user}', [TwoFactorController::class, 'disable'])
        ->middleware('throttle:6,1')
        ->name('2fa.disable');
});
