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

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');

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
<<<<<<< HEAD
=======

    Route::group([
        'prefix' => 'referrals'
    ], function () {
        Route::get('', [IndexController::class, 'referral'])->name('referral');
        Route::get('/attached-referrals', [IndexController::class, 'referral'])->name('referral.attached');
        Route::get('/incomes', [IndexController::class, 'referral'])->name('referral.incomes');
        Route::get('{user}', ListReferralController::class)->name('referral.list');
        Route::post('/generate/{user}', CodeController::class)->name('code');
        Route::get('/statistic/{user}', StatisticReferralController::class)->name('referral.show');
        Route::get('/incomes/{user}', ReferralIncomeListController::class)->name('referral.income.list');
        Route::post('/attach/{user}', AttachReferralController::class)->name('referral.attach');
    });
>>>>>>> 344af8d (refactor: referrals routes)
});

Route::get('/verify/{id}/{hash}', VerificationController::class)->name('verification.verify');
