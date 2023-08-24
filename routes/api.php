<?php

use App\Http\Controllers\Api\ChartController;
use App\Http\Controllers\Api\HashRateListController;
use App\Http\Controllers\Api\IncomeListController;
use App\Http\Controllers\Api\PayoutListController;
use App\Http\Controllers\Api\Sub\ListController as SubListController;
use App\Http\Controllers\Api\Sub\ShowController as SubShowController;
use App\Http\Controllers\Api\WalletListController;
use App\Http\Controllers\Api\WorkerHashRateController;
use App\Http\Controllers\Api\Worker\ListController as WorkerListController;
use App\Http\Controllers\Api\Worker\ShowController as WorkerShowController;
use App\Http\Controllers\Referral\AttachController as AttachReferralController;
use App\Http\Controllers\MinerStatController;
use App\Http\Controllers\Referral\CodeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Referral\StatisticController as StatisticReferralController;
use \App\Http\Controllers\Referral\ListController as ReferralListController;
use App\Http\Controllers\Referral\IncomeListController as ReferralIncomeListController;

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

/*Route::group([
    'prefix' => 'referrals'
], function () {
    Route::post('/generate/{user}', CodeController::class)->name('code');
    Route::get('/statistic/{user}', StatisticReferralController::class)->name('referral.show');
    Route::get('{user}', ReferralListController::class)->name('referral.list');
    Route::post('/attach/{user}', AttachReferralController::class)->name('referral.attach');
    Route::get('/incomes/{user}', ReferralIncomeListController::class)->name('referral.income.list');

});*/

/*Route::group([
    'prefix' => 'subs',
], function () {
    Route::get('{user}', SubListController::class)->name('sub.list');
});*/
//
/*Route::group([
    'prefix' => 'incomes',
], function () {
    Route::get('{sub}', IncomeListController::class)->name('income.list');
});*/
//
//Route::group([
//    'prefix' => 'payouts',
//], function () {
//    Route::get('{sub}', PayoutListController::class)->name('payout.list');
//});
//
//Route::group([
//    'prefix' => 'sub',
//], function () {
//    Route::get('{sub}/workers', WorkerListController::class)->name('sub.worker.list');
//    Route::get('{sub}', SubShowController::class)->name('sub.show');
//});
//
//Route::group([
//    'prefix' => 'worker',
//], function () {
//    Route::get('{worker}', WorkerShowController::class)->name('worker.show');
//});
//
//Route::group([
//    'prefix' => 'hashrate',
//], function () {
//    Route::get('{sub}', HashRateListController::class)->name('hashrate.list');
//});
//
//Route::group([
//    'prefix' => 'workerhashrate',
//], function () {
//    Route::get('{worker}', WorkerHashRateController::class)->name('worker_hashrate.list');
//});
//
//Route::group([
//    'prefix' => 'wallets',
//], function () {
//    Route::get('{sub}', WalletListController::class)->name('wallet.list');
//});
//
Route::get('/miner_stat', MinerStatController::class)->name('miner_stat');
Route::get('/chart', ChartController::class)->name('chart');
