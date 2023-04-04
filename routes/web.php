<?php

use App\Http\Controllers\Accuals\AccrualController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Hashes\HashController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Payments\PaymentController;
use App\Http\Controllers\Requests\RequestController;
use App\Http\Controllers\Subs\SubController;
use App\Http\Controllers\Transactions\TransactionController;
use App\Http\Controllers\Wallets\WalletController;
use App\Http\Controllers\Workers\WorkerController;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\Payment\PaymentController;

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

Route::controller(SubController::class)->group(function () {
    Route::put('/sub_create', 'create')->name('sub_create');
});

Route::controller(IndexController::class)
    ->group(function () {
        Route::get('/', 'index')->name('home');
//        Route::get('/help', 'help')->name('help');
//        Route::get('/about', 'about')->name('about');
        Route::get('/complexity', 'complexity')->name('complexity');
    });

Route::middleware('guest:web')->group(function () {
    Route::post("/user_get", [RegisterController::class, "getter"])->name('user_get');
});

Route::controller(VerificationController::class)
    ->group(function () {
        Route::get('/email/verify', 'show')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
        Route::get('/email/resend', 'resend')->name('verification.resend');
    });

Route::controller(RequestController::class)
    ->group(function () {
        Route::get('/accountsAll', 'accountsAll')->name('accountsAll');
        Route::put('/worker', 'worker')->name('worker');
        Route::post('/worker_update', 'worker_update')->name('worker_update');
        Route::get('/earn_list', 'earn_list')->name('earn_list');
        Route::put('/history', 'history')->name('history');
    });

Route::middleware('auth')->group(function () {
    Route::controller(IndexController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::redirect('/profile', '/profile/accounts');
        Route::get('/wallets', 'wallets')->name('wallets');
//        Route::get('/history', 'history')->name('history');
//        Route::get('/ref-page', 'ref_page')->name('ref_page');
        Route::get('/settings', 'settings')->name('settings');
        Route::prefix('/profile')->group(function () {
            Route::get('/accounts', 'accounts')->name('accounts');
            Route::get('/statistic', 'statistic')->name('statistic');
            Route::get('/workers', 'workers')->name('workers');
            Route::get('/payment', 'payment')->name('payment');
            Route::get('/accruals', 'accruals')->name('accruals');
            Route::get('/connecting', 'connecting')->name('connecting');
        });

    });

    Route::controller(WorkerController::class)->group(function () {
        Route::post('/worker_create', 'create')->name('worker_create');
        Route::put('/worker_process', 'visual')->name('worker_process');
    });
    Route::controller(HashController::class)->group(function () {
        Route::put('/hash_process', 'visual')->name('hash_process');
    });
    Route::controller(TransactionController::class)->group(function () {
        Route::post("/set_payment", "store")->name('set_payment');
        Route::get("/render_payment", "render")->name('render_payment');
    });
    Route::controller(SubController::class)->group(function () {
        Route::get('/sub_process', 'visual')->name('sub_process');
        Route::get('/sub_strong_delete', 'delete')->name('sub_strong_delete');
        Route::put('/sub_delete', 'remove')->name('sub_delete');
    });
    Route::controller(AccrualController::class)->group(function () {
        Route::put('/accrual_create', 'create')->name('accrual_create');
        Route::put('/accrual_update', 'update')->name('accrual_update');
        Route::put('/accrual_process', 'visual')->name('accrual_process');
    });
    Route::controller(WalletController::class)->group(function () {
        Route::post('/wallet_update', 'update')->name('wallet_update');
        Route::put('/wallet_process', 'visual')->name('wallet_process');
    });
    Route::controller(PaymentController::class)->group(function () {
        Route::get('/see_balance', 'getBalance')->name('see_balance');
        Route::post('/send_payment', 'sendPayment')->name('send_payment');
    });
});
