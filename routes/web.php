<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
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


Route::controller(IndexController::class)
    ->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/help', 'help')->name('help');
        Route::get('/about', 'about')->name('about');
        Route::get('/complexity', 'complexity')->name('complexity');
    });

Route::middleware('guest:web')->group(function () {
    Route::redirect("/login", '/#login')
        ->name('login');
    Route::post('/login_process', [AuthController::class, 'login'])
        ->name('login_process');
});

Route::middleware('auth:web')->group(function () {
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])
        ->name('logout');

    Route::controller(IndexController::class)->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::redirect('/profile', '/profile/accounts');
        Route::get('/wallets', 'wallets')->name('wallets');
        Route::get('/ref-page', 'ref_page')->name('ref_page');
        Route::prefix('/profile')->group(function () {
            Route::get('/accounts', 'accounts')->name('accounts');
            Route::get('/statistic', 'statistic')->name('statistic');
            Route::get('/workers', 'workers')->name('workers');
            Route::get('/payment', 'payment')->name('payment');
            Route::get('/accruals', 'accruals')->name('accruals');
            Route::get('/connecting', 'connecting')->name('connecting');
        });

    });
});

//require __DIR__.'/auth.php';
