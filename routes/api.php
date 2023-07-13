<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
//Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
//Route::middleware('auth:sanctum')->group(function () {
//    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
//    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
//});

Route::post('/has_user', function (\Illuminate\Http\Request $request) {
    (new \App\Services\External\BtcComService(new \GuzzleHttp\Client()))
        ->btcHasUser(
            $request->all()
        );
});
