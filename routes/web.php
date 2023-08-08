<?php

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Hashes\HashRateListController;
use App\Http\Controllers\Income\ListController as IncomeListController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MinerStatController;
use App\Http\Controllers\SendMessage\SendMessageConroller;
use App\Http\Controllers\Sub\ListController as SubListController;
use App\Http\Controllers\Sub\CreateController as SubCreateController;
use App\Http\Controllers\Sub\ShowController as SubShowController;
use App\Http\Controllers\Workers\ListController as WorkerListController;
use App\Http\Controllers\Workers\ShowController as WorkerShowController;
use App\Http\Controllers\WorkerHashRate\ListController as WorkerHashRateListController;
use App\Http\Controllers\Wallet\ListController as WalletListController;
use App\Http\Controllers\Wallet\CreateController as WalletCreateController;
use App\Http\Controllers\Wallet\UpdateController as WalletUpdateController;
use App\Http\Controllers\Payout\ListController as PayoutListController;
use App\Http\Controllers\UserController;
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

/* Public routes */
Route::group([
    'prefix' => '',
    'controller' => IndexController::class
], function () {
    Route::get('/', 'index')->name('home');
    Route::get('/help', 'help')->name('help');
    Route::get('/hosting', 'hosting')->name('hosting');
    Route::get('/registration', 'registration')->name('registration');
    Route::get('/login', 'login')->name('login');
});

Route::get('/miner_stat', MinerStatController::class)->name('miner_stat');
Route::get('/chart', ChartController::class)->name('chart');

/* Must auth web routes */
Route::middleware('auth')->group(function () {
    Route::group([
        'prefix' => 'subs',
    ], function () {
        Route::get('{user}', SubListController::class)->name('sub.list');
        Route::get('{sub}', SubShowController::class)->name('sub.show');
        Route::post('/create', SubCreateController::class)->name('sub.create');
    });

    Route::group([
        'prefix' => 'workers',
    ], function () {
        Route::get('{sub}', WorkerListController::class)->name('worker.list');
        Route::post('{worker}', WorkerShowController::class)->name('worker.show');
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
    Route::get('workerhashrate/{worker}', WorkerHashRateListController::class)->name('worker_hashrate.list');

    Route::group([
        'prefix' => '',
        'controller' => IndexController::class
    ], function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::redirect('/profile', '/profile/statistic');

        Route::group([
            'prefix' => 'profile',
        ], function () {
            Route::get('/statistic', 'statistic')->name('statistic');
            Route::get('/accounts', 'accounts')->name('accounts');
            Route::get('/workers', 'workers')->name('workers');
            Route::get('/full-page/settings', 'settings')->name('settings');
            Route::get('/full-page/income', 'income')->name('income');
            Route::get('/full-page/wallets', 'wallets')->name('wallets');
            Route::get('/connecting', 'connecting')->name('connecting');
        });
    });

    Route::group([
        'prefix' => '',
        'controller' => UserController::class
    ], function () {
        Route::get('/get_login', 'login')->name('get_login');
        Route::get('/get_email', 'email')->name('get_email');
        Route::get('/get_phone', 'phone')->name('get_phone');
        Route::get('/get_sms', 'sms')->name('get_sms');
        Route::get('/get_fac', 'fac')->name('get_fac');
        Route::post('/change', 'change')->name('change');
    });

    Route::post('/send_message', SendMessageConroller::class)->name('send_message');
    Route::post('/password/reset', [ResetPasswordController::class, 'changePassword']);
});
