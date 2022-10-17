<?php

use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Requests $request) {
    return $request->user();
});*/

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);
    Route::get('user', [UserAuthController::class, 'user']);
    Route::post('refresh', [UserAuthController::class, 'refresh']);
    Route::post('logout', [UserAuthController::class, 'logout']);
});

Route::prefix('/orders')->group(function () {

    Route::get('/', ['uses' => 'OrderController@get']);
    Route::get('/{id}', ['uses' => 'OrderController@detail'])->where(['id' => '[0-9+]']);
    Route::post('/', ['uses' => 'OrderController@createOrder']);
    Route::delete('/{id}', ['uses' => 'OrderController@delete'])->where(['id' => '[0-9+]']);
    Route::put('/{id}', ['uses' => 'OrderController@updateOrder'])->where(['id' => '[0-9+]']);

});
