<?php

use App\Http\Controllers\Api\IncomeListController;
use App\Http\Controllers\Api\Subs\ListController;
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
    'middleware' => 'throttle:api'
], function () {
   Route::get('{sub}', IncomeListController::class)->name('income.list');
});

Route::group([
    'prefix' => 'subs',
    'middleware' => 'throttle:api'
], function () {
    Route::get('{user}', ListController::class)->name('sub.list');
});
