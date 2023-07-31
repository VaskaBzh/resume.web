<?php

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Hashes\HashController;
use App\Http\Controllers\Income\IncomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SendMessage\SendMessageConroller;
use App\Http\Controllers\Subs\SubController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Wallets\WalletController;
use App\Http\Controllers\Workers\WorkerController;
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

Route::middleware('auth')->group(function () {
    Route::group([
        'prefix' => '',
        'controller' => SubController::class
    ], function () {
        Route::post('/sub_create', 'create')->name('sub_create');
        Route::get('/sub_process', 'visual')->name('sub_process');
    });

    Route::group([
        'prefix' => '',
        'controller' => WorkerController::class
    ], function () {
        Route::post('/worker_create', 'create')->name('worker_create');
        Route::get('/worker_process', 'visual')->name('worker_process');
    });

    Route::group([
        'prefix' => '',
        'controller' => WalletController::class
    ], function () {
        Route::post('/wallet_create', 'create')->name('wallet_create');
        Route::post('/wallet_delete', 'delete')->name('wallet_delete');
        Route::post('/wallet_change', 'change')->name('wallet_change');
        Route::get('/wallet_process', 'visual')->name('wallet_process');
    });

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

    Route::get('/income_process', IncomeController::class)->name('income_process');
    Route::get('/hash_process', HashController::class)->name('hash_process');
    Route::post('/send_message', SendMessageConroller::class)->name('send_message');
    Route::post('/password/reset', [ResetPasswordController::class, 'changePassword']);
});
