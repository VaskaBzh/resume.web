<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Hashes\HashRateListController;
use App\Http\Controllers\Income\ListController as IncomeListController;
use App\Http\Controllers\MinerStatController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Referral\CodeController;
use App\Http\Controllers\SendMessage\SendMessageConroller;
use App\Http\Controllers\Sub\ListController as SubListController;
use App\Http\Controllers\Sub\CreateController as SubCreateController;
use App\Http\Controllers\Sub\ShowController as SubShowController;
use App\Http\Controllers\Workers\ListController as WorkerListController;
use App\Http\Controllers\Workers\ShowController as WorkerShowController;
use App\Http\Controllers\WorkerHashRate\ListController as WorkerHashRateListController;
use App\Http\Controllers\Referral\StatisticController as StatisticReferralController;
use App\Http\Controllers\Wallet\ListController as WalletListController;
use App\Http\Controllers\Wallet\CreateController as WalletCreateController;
use App\Http\Controllers\Wallet\UpdateController as WalletUpdateController;
use App\Http\Controllers\Payout\ListController as PayoutListController;
use App\Http\Controllers\Referral\ListController as ListReferralController;
use App\Http\Controllers\Referral\AttachController as AttachReferralController;
use App\Http\Controllers\Referral\IncomeListController as ReferralIncomeListController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

/* Public routes */


Route::get('/miner_stat', MinerStatController::class)->name('miner_stat');
Route::get('/chart', ChartController::class)->name('chart');

Route::group([
    'prefix' => '',
    'controller' => PageController::class
], function () {
    Route::get('/', 'index')->name('home');
    Route::get('/{page}', 'show')->name('page');
});

/* Must auth web routes */
Route::middleware('auth')->group(function () {

    Route::get('/profile/{page}', [PageController::class, 'show'])->name('profile.index');

    Route::group([
        'prefix' => 'subs',
    ], function () {
        Route::get('{user}', SubListController::class)->name('sub.list');
        Route::get('/sub/{sub}', SubShowController::class)->name('sub.show');
        Route::post('/create', SubCreateController::class)->name('sub.create');
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
        Route::post('/create', WalletCreateController::class)->name('wallet.create');
        Route::post('/update', WalletUpdateController::class)->name('wallet.update');
    });

    Route::get('/payouts/{sub}', PayoutListController::class)->name('payout.list');
    Route::get('/incomes/{sub}', IncomeListController::class)->name('income.list');
    Route::get('/hashrate/{sub}', HashRateListController::class)->name('hash.list');
    Route::get('/workerhashrate/{worker}', WorkerHashRateListController::class)->name('worker_hashrate.list');

//    Route::group([
//        'prefix' => '2fac'
//    ], function () {
//        Route::post('enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
//        Route::get('show', [IndexController::class, 'twoFactorAuth'])->name('2fa.show');
//        Route::post('verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');
//    });

    Route::post('/change/{user}', AccountController::class)->name('change');
    Route::post('/send_message', SendMessageConroller::class)->name('send_message');

    Route::group([
        'prefix' => 'referrals'
    ], function () {
        Route::get('/{user}', ListReferralController::class)->name('referral.list');
        Route::post('/generate/{user}', CodeController::class)->name('code');
        Route::get('/statistic/{user}', StatisticReferralController::class)->name('referral.show');
        Route::get('/incomes/{user}', ReferralIncomeListController::class)->name('referral.income.list');
        Route::post('/attach/{user}', AttachReferralController::class)->name('referral.attach');
    });
});

