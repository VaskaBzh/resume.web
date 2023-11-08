<?php

use App\Http\Controllers\Api\AllowedRoutesController;
use App\Http\Controllers\Api\ChartController;
use App\Http\Controllers\Api\Incomes\ListController;
use App\Http\Controllers\Api\MinerStatController;
use App\Http\Controllers\Api\Payout\ListController as PayoutListController;
use App\Http\Controllers\Api\Referral\IncomeListController as ReferralIncomeListController;
use App\Http\Controllers\Api\Referral\ListController as ReferralListController;
use App\Http\Controllers\Api\Referral\StatisticController as ReferralStatisticController;
use App\Http\Controllers\Api\SendCodeController;
use App\Http\Controllers\Api\Sub\CreateController as SubCreateController;
use App\Http\Controllers\Api\Sub\ListController as SubListController;
use App\Http\Controllers\Api\Sub\ShowController as SubShowController;
use App\Http\Controllers\Api\Sub\ActivateController as SubActivateController;
use App\Http\Controllers\Api\StatisticController as SubStatisticController;
use App\Http\Controllers\Api\Wallet\ChangeAddressController as WalletChangeAddressController;
use App\Http\Controllers\Api\Wallet\CreateController as WalletCreateController;
use App\Http\Controllers\Api\Wallet\ListController as WalletListController;
use App\Http\Controllers\Api\Wallet\UpdateController as WalletUpdateController;
use App\Http\Controllers\Api\WatcherLink\CreateController as WatcherLinkCreateController;
use App\Http\Controllers\Api\WatcherLink\DeleteController as WatcherLinkDeleteController;
use App\Http\Controllers\Api\WatcherLink\ListController as WatcherLinkListController;
use App\Http\Controllers\Api\WatcherLink\ShowController as WatcherLinkShowController;
use App\Http\Controllers\Api\WatcherLink\UpdateController as WatcherLinkUpdateController;
use App\Http\Controllers\Api\Worker\ListController as WorkerListController;
use App\Http\Controllers\Api\Worker\ShowController as WorkerShowController;
use App\Http\Controllers\Api\WorkerHashRateController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/* _________________ Public routes ____________________ */

Route::get('/minerstats', MinerStatController::class)->name('miner_stat');
Route::get('/chart', ChartController::class)->name('chart');

/* _________________ End public routes ____________________ */


/* ________________ Protected routes ____________________ */

/* Can be allowed */
Route::group([
    'middleware' => ['watcher-link', 'auth:sanctum']
], function () {
    Route::group([
        'prefix' => 'subs',
    ], function () {
        Route::get('/{user}', SubListController::class)->name('sub.list');
        Route::get('/sub/{sub}', SubShowController::class)->name('sub.show');
        Route::put('/sub/activate/{sub}', SubActivateController::class)->name('sub.activate');
    });

    Route::group([
        'prefix' => 'workers',
    ], function () {
        Route::get('/{sub}', WorkerListController::class)->name('worker.list');
        Route::get('/worker/{worker}', WorkerShowController::class)->name('worker.show');
    });

    Route::get('/statistic/{sub}', SubStatisticController::class)->name('statistic.show');
    Route::get('/incomes/{sub}', ListController::class)->name('income.list');
    Route::get('/payouts/{sub}', PayoutListController::class)->name('payout.list');
    Route::get('/workerhashrate/{worker}', WorkerHashRateController::class)->name('worker_hashrate.list');
    Route::get('/allowed/{token}', AllowedRoutesController::class)->name('allowed-routes');
});
/* End allowable routes  */

Route::group([
    'middleware' => ['auth:sanctum', 'verified']
], function () {
    Route::get('/user/{user}', UserController::class)->name('user.show');
    Route::put('/decrease/token', [LoginController::class, 'decreaseTokenTime'])
        ->middleware('throttle:6,1');

    Route::group([
        'prefix' => 'subs',
    ], function () {
        Route::post('/create/{user}', SubCreateController::class)->name('sub.create');
    });

    Route::group([
        'prefix' => 'wallets',
    ], function () {
        Route::put('/update/{wallet}', WalletUpdateController::class)
            ->middleware('throttle:6,1')
            ->name('wallet.update');
        Route::put('/change/address/{wallet}', WalletChangeAddressController::class)
            ->middleware('throttle:6,1')
            ->name('wallet.change.address');
        Route::post('/create', WalletCreateController::class)
            ->middleware('throttle:6,1')
            ->name('wallet.create');
        Route::get('/{sub}', WalletListController::class)->name('wallet.list');
    });

    Route::group([
        'prefix' => 'referrals',
        'middleware' => 'role:referrer'
    ], function () {
        Route::get('/{user}', ReferralListController::class)->name('referral.list');
        Route::get('/statistic/{user}', ReferralStatisticController::class)->name('referral.show');
        Route::get('/incomes/{user}', ReferralIncomeListController::class)->name('referral.income.list');
    });

    Route::group(['prefix' => 'watchers'], function () {
        Route::get('/{watcher}', WatcherLinkShowController::class);
        Route::get('/{user}/{sub}', WatcherLinkListController::class);
        Route::post('/create/{sub}', WatcherLinkCreateController::class)
            ->middleware('throttle:6,1');
        Route::put('/update/{watcher}', WatcherLinkUpdateController::class)
            ->middleware('throttle:6,1');
        Route::delete('/delete/{watcher}', WatcherLinkDeleteController::class)
            ->middleware('throttle:6,1');
    });

    Route::post('/send/code/{user}', SendCodeController::class)
        ->middleware('throttle:3,1')
        ->name('send-code');
});
/* ________________ End protected routes ____________________ */
