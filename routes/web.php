<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Hashes\HashController;
use App\Http\Controllers\Income\IncomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Requests\RequestController;
use App\Http\Controllers\SendMessage\SendMessageConroller;
use App\Http\Controllers\Subs\SubController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Wallets\WalletController;
use App\Http\Controllers\Workers\WorkerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//use App\Http\Controllers\AuthController;

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

Auth::routes();

Route::controller(HashController::class)->group(function () {
    Route::put('/hash_create', 'create')->name('hash_create');
});

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
    ],function () {
        Route::post('/worker_create', 'create')->name('worker_create');
        Route::get('/worker_process', 'visual')->name('worker_process');
    });
});



Route::controller(SendMessageConroller::class)->group(function () {
    Route::post('/send_message', 'send_message')->name('send_message');
});

Route::controller(IndexController::class)
    ->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/help', 'help')->name('help');
        Route::get('/complexity', 'complexity')->name('complexity');
        Route::get('/hosting', 'hosting')->name('hosting');
        Route::get('/registration', 'registration')->name('registration');
        Route::get('/login', 'login')->name('login');
    });

Route::controller(RegisterController::class)->group(function () {
    Route::post("/user_get", "getter")->name('user_get');
    Route::post("/get_name", "getName")->name('get_name');
});

Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'verify'])->name('verification.verify');

Route::controller(LocationController::class)->group(function () {
    Route::post("/get_location", "get_location")->name('get_location');
    Route::post("/set_location", "set_location")->name('set_location');
});

Route::controller(LoginController::class)->group(function () {
    Route::post("/reverify", "verify")->name('reverify');
});

Route::controller(VerificationController::class)
    ->group(function () {
        Route::get('/email/verify', 'show')->name('verification.notice');
//        Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
        Route::get('/email/resend', 'resend')->name('verification.resend');
    });

Route::controller(RequestController::class)
    ->group(function () {
        Route::put('/proxy', 'proxy_front')->name('proxy');
        Route::put('/proxy_diff', 'proxy_diff')->name('proxy_diff');
    });

Route::middleware('auth')->group(function () {
    Route::controller(IndexController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::redirect('/profile', '/profile/statistic');
//        Route::get('/ref-page', 'ref_page')->name('ref_page');
        Route::prefix('/profile')->group(function () {
            Route::get('/statistic', 'statistic')->name('statistic');
            Route::get('/accounts', 'accounts')->name('accounts');
            Route::get('/workers', 'workers')->name('workers');
            Route::get('/full-page/settings', 'settings')->name('settings');
            Route::get('/full-page/income', 'income')->name('income');
            Route::get('/full-page/wallets', 'wallets')->name('wallets');
            Route::get('/connecting', 'connecting')->name('connecting');
        });
    });

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::post('/password/reset', 'changePassword');
    });


    Route::controller(HashController::class)->group(function () {
        Route::get('/hash_process', 'visual')->name('hash_process');
    });

    Route::controller(IncomeController::class)->group(function () {
        Route::get('/income_process', 'visual')->name('income_process');
    });
    Route::controller(WalletController::class)->group(function () {
        Route::post('/wallet_create', 'create')->name('wallet_create');
        Route::post('/wallet_delete', 'delete')->name('wallet_delete');
        Route::post('/wallet_change', 'change')->name('wallet_change');
        Route::get('/wallet_process', 'visual')->name('wallet_process');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/get_login', 'login')->name('get_login');
        Route::get('/get_email', 'email')->name('get_email');
        Route::get('/get_phone', 'phone')->name('get_phone');
        Route::get('/get_sms', 'sms')->name('get_sms');
        Route::get('/get_fac', 'fac')->name('get_fac');
        Route::post('/change', 'change')->name('change');
    });
});
