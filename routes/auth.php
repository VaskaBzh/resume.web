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
    'login' => false,
]);

Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login')
        ->name('login');

    Route::post('/logout', 'logout')
        ->middleware('auth:sanctum')
        ->name('logout');
});

Route::get('/verify/{id}/{hash}', VerificationController::class)
    ->name('verification.verify')
    ->middleware('signed');

Route::post('/email/verify', ResendVerifyEmailController::class)
    ->name('resend-verify-email');

Route::group([
    'prefix' => 'password',
], function () {
    Route::put('/restore/{user}', [ResetPasswordController::class, 'restorePassword'])
        ->name('restore.password');
    Route::post('/forgot', [ForgotPasswordController::class, 'sendLink'])
        ->name('password.reset.link');
    Route::get('/reset/verify/{id}/{hash}', [ResetPasswordController::class, 'verifyPasswordReset'])
        ->middleware('signed')
        ->name('password.reset.verify');
    Route::put('/change/{user}', PasswordChangeController::class)
        ->name('password-change')
        ->middleware('auth:sanctum');
});

Route::controller(TwoFactorController::class)
    ->prefix('2fac')
    ->middleware(['auth:sanctum'])
    ->group(static function () {
        Route::get('/qrcode/{user}', 'qrCode')->name('2fa.qrcode');
        Route::put('/enable/{user}', 'enable')->name('2fa.enable');
        Route::put('/disable/{user}', 'disable')->name('2fa.disable');
    });
