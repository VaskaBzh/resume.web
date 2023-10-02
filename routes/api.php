<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AllowedRoutesController;
use App\Http\Controllers\Api\ChartController;
use App\Http\Controllers\Api\HashRateListController;
use App\Http\Controllers\Api\Incomes\ListController;
use App\Http\Controllers\Api\MinerStatController;
use App\Http\Controllers\Api\Payout\ListController as PayoutListController;
use App\Http\Controllers\Api\Referral\CodeController as ReferralCodeController;
use App\Http\Controllers\Api\Referral\IncomeListController as ReferralIncomeListController;
use App\Http\Controllers\Api\Referral\ListController as ReferralListController;
use App\Http\Controllers\Api\Referral\StatisticController as ReferralStatisticController;
use App\Http\Controllers\Api\Sub\CreateController as SubCreateController;
use App\Http\Controllers\Api\Sub\ListController as SubListController;
use App\Http\Controllers\Api\Sub\ShowController as SubShowController;
use App\Http\Controllers\Api\Wallet\CreateController as WalletCreateController;
use App\Http\Controllers\Api\Wallet\ListController as WalletListController;
use App\Http\Controllers\Api\Wallet\UpdateController as WalletUpdateController;
use App\Http\Controllers\Api\Worker\ListController as WorkerListController;
use App\Http\Controllers\Api\Worker\ShowController as WorkerShowController;
use App\Http\Controllers\Api\WatcherLink\CreateController as WatcherLinkCreateController;
use App\Http\Controllers\Api\WatcherLink\ListController as WatcherLinkListController;
use App\Http\Controllers\Api\WatcherLink\UpdateController as WatcherLinkUpdateController;
use App\Http\Controllers\Api\WatcherLink\DeleteController as WatcherLinkDeleteController;
use App\Http\Controllers\Api\WatcherLink\ShowController as WatcherLinkShowController;
use App\Http\Controllers\Api\WorkerHashRateController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResendVerifyEmailController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/* _________________ Public routes ____________________ */

Route::get('/miner_stat', MinerStatController::class)->name('miner_stat');
Route::get('/chart', ChartController::class)->name('chart');

Route::group(['middleware' => ['signed', 'throttle:6,1']], function () {
    Route::get('/verify/{id}/{hash}', VerificationController::class)
        ->name('verification.verify');
    Route::get('/password/reset/verify/{id}/{hash}', [ResetPasswordController::class, 'verifyPasswordChange'])
        ->name('password.reset.verify');
});

Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->middleware('throttle:3,1');

/* _________________ End public routes ____________________ */


/* ________________ Protected routes ____________________ */

/* Can be allowed */
Route::group([
    'middleware' => ['watcher-link', 'auth:sanctum']
], function () {
    Route::group([
        'prefix' => 'subs',
    ], function () {
        Route::get('{user}', SubListController::class)->name('sub.list');
        Route::get('/sub/{sub}', SubShowController::class)->name('sub.show');
    });

    Route::group([
        'prefix' => 'workers',
    ], function () {
        Route::get('/{sub}', WorkerListController::class)->name('worker.list');
        Route::get('/worker/{worker}', WorkerShowController::class)->name('worker.show');
    });

    Route::get('/hashrate/{sub}', HashRateListController::class)->name('hashrate.list');
    Route::get('/incomes/{sub}', ListController::class)->name('income.list');
    Route::get('/payouts/{sub}', PayoutListController::class)->name('payout.list');
    Route::get('/workerhashrate/{worker}', WorkerHashRateController::class)->name('worker_hashrate.list');
    Route::get('/allowed/{token}', AllowedRoutesController::class)->name('allowed-routes');
});
/* End allowable routes  */

Route::group([
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/user', UserController::class)->name('user.show');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(['middleware' => 'throttle:3,1'], function () {
        Route::post('/email/reverify', ResendVerifyEmailController::class)
            ->name('resend-verify-email');
        Route::post('/password/reset', [ResetPasswordController::class, 'sendEmail'])
            ->name('password-reset.send-email');
    });

    Route::put('/password/change', [ResetPasswordController::class, 'changePassword']);
    Route::put('/change', AccountController::class)->name('change');
    Route::put('/decrease/token', [LoginController::class, 'decreaseTokenTime']);

    Route::group([
        'prefix' => '2fac'
    ], function () {
        Route::put('enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
        Route::post('verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');
    });

    Route::group([
        'prefix' => 'subs',
    ], function () {
        Route::post('/create', SubCreateController::class)->name('sub.create');
    });

    Route::group([
        'prefix' => 'wallets',
        'middleware' => ['verified', 'verify-expiration']
    ], function () {
        Route::put('/update/{wallet}', WalletUpdateController::class)->name('wallet.update');
        Route::post('/create', WalletCreateController::class)->name('wallet.create');
        Route::get('/{sub}', WalletListController::class)->name('wallet.list');
    });

    Route::group([
        'prefix' => 'referrals',
        'middleware' => 'role:referral'
    ], function () {
        Route::get('', ReferralListController::class)->name('referral.list');
        Route::post('/generate', ReferralCodeController::class)->name('code');
        Route::get('/statistic', ReferralStatisticController::class)->name('referral.show');
        Route::get('/incomes', ReferralIncomeListController::class)->name('referral.income.list');
    });

    Route::group(['prefix' => 'watchers'], function () {
        Route::get('/{watcher}', WatcherLinkShowController::class);
        Route::get('/{user}/{sub}', WatcherLinkListController::class);
        Route::post('/create/{sub}', WatcherLinkCreateController::class);
        Route::put('/update/{watcher}', WatcherLinkUpdateController::class);
        Route::delete('/delete/{watcher}', WatcherLinkDeleteController::class);
    });
});
/* ________________ End protected routes ____________________ */
