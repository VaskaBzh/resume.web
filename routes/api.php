<?php

use App\Http\Controllers\Api\IncomeListController;
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
