<?php

use App\Http\Controllers\Api\ChartController;
use App\Http\Controllers\Api\HashRateListController;
use App\Http\Controllers\Api\IncomeListController;
use App\Http\Controllers\Api\Subs\ListController;
use App\Http\Controllers\Api\Subs\ShowController;
use App\Http\Controllers\MinerStat\MinerStatController;
use Illuminate\Support\Facades\Route;

//
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

Route::group([
    'prefix' => 'incomes',
], function () {
   Route::get('{sub}', IncomeListController::class)->name('income.list');
});

Route::group([
    'prefix' => 'subs',
], function () {
    Route::get('{user}', ListController::class)->name('sub.list');
});

Route::group([
    'prefix' => 'sub',
], function () {
    Route::get('{sub}', ShowController::class)->name('sub.show');
});

Route::group([
    'prefix' => 'hashrate',
], function () {
    Route::get('{sub}', HashRateListController::class)->name('hashrate.list');
});

Route::get('/miner_stat', MinerStatController::class)->name('miner_stat');
Route::get('/chart', ChartController::class)->name('chart');
