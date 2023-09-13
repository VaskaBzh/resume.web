<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\ChartController;
use App\Http\Controllers\Api\HashRateListController;
use App\Http\Controllers\Api\Incomes\ListController;
use App\Http\Controllers\Api\MinerStatController;
use App\Http\Controllers\Api\PayoutListController;
use App\Http\Controllers\Api\Referral\AttachController as ReferralAttachController;
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
use App\Http\Controllers\Api\WatcherLink\ListController as WatcherLinkController;
use App\Http\Controllers\Api\WatcherLink\UpdateController as WatcherUpdateController;
use App\Http\Controllers\Api\WorkerHashRateController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/* _________________ Public routes ____________________ */

Route::get('/miner_stat', MinerStatController::class)->name('miner_stat');
Route::get('/chart', ChartController::class)->name('chart');
Route::get('/verify/{id}/{hash}', VerificationController::class)->name('verification.verify');
/* _________________ End public routes ____________________ */



/* ________________ Protected routes ____________________ */

/*                        GET                             */
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
        Route::get('{sub}', WorkerListController::class)->name('worker.list');
        Route::get('worker/{worker}', WorkerShowController::class)->name('worker.show');
    });

    Route::group([
        'prefix' => 'wallets',
    ], function () {
        Route::get('{sub}', WalletListController::class)->name('wallet.list');
    });

    Route::get('/hashrate/{sub}', HashRateListController::class)->name('hashrate.list');
    Route::get('/incomes/{sub}', ListController::class)->name('income.list');
    Route::get('payouts/{sub}', PayoutListController::class)->name('payout.list');
    Route::get('/workerhashrate/{worker}', WorkerHashRateController::class)->name('worker_hashrate.list');
});

/*                        POST & PUT                            */
Route::group([
    'middleware' => 'auth:sanctum'
], function () {
    Route::post('logout', [LoginController::class, 'logout']);
    Route::put('reset', [ResetPasswordController::class, 'changePassword']);
    Route::put('/change/{user}', AccountController::class)->name('change');

    Route::group([
        'prefix' => 'subs',
    ], function () {
        Route::post('/create', SubCreateController::class)->name('sub.create');
    });

    Route::group([
        'prefix' => 'wallets',
    ], function () {
        Route::post('/create', WalletCreateController::class)->name('wallet.create');
        Route::put('/update', WalletUpdateController::class)->name('wallet.update');
    });

    Route::group([
        'prefix' => 'referrals',
        'middleware' => 'role:referral'
    ], function () {
        Route::get('/{user}', ReferralListController::class)->name('referral.list');
        Route::post('/generate/{user}', ReferralCodeController::class)->name('code');
        Route::get('/statistic/{user}', ReferralStatisticController::class)->name('referral.show');
        Route::get('/incomes/{user}', ReferralIncomeListController::class)->name('referral.income.list');
        Route::post('/attach/{user}', ReferralAttachController::class)->name('referral.attach');
    });

    Route::group(['prefix' => 'watchers'], function () {
        Route::get('/{user}/{sub}', WatcherLinkController::class);
        Route::post('/create/{sub}', WatcherLinkCreateController::class);
        Route::put('/update/{sub}/{watcher}', WatcherUpdateController::class);
    });
});
/* ________________ End protected routes ____________________ */
