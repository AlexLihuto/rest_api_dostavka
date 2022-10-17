<?php

use App\Http\Controllers\SellerOrderController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\OrderController;
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

Route::group(['middleware' => 'api'], function () {
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);
    Route::get('user', [UserAuthController::class, 'user']);
    Route::post('refresh', [UserAuthController::class, 'refresh']);
    Route::post('logout', [UserAuthController::class, 'logout']);

});

Route::group(['middleware' => ['role:super-admin'], 'prefix' => 'admin'], function () {
    Route::get('/orders', [OrderController::class, 'getAll']);
    Route::post('/orders', [OrderController::class, 'createOrder']);
    Route::get('/orders/{id}', [OrderController::class, 'detail']);
    Route::put('/orders/{id}', [OrderController::class, 'updateOrder']);
    Route::delete('/orders/{id}', [OrderController::class, 'delete']);
});

Route::group(['middleware' => ['role:buyer'], 'prefix' => 'buyer'], function () {
    Route::post('/orders', [OrderController::class, 'createOrder']);
});

Route::group(['middleware' => ['role:seller'], 'prefix' => 'seller'], function () {
    Route::get('/orders', [OrderController::class, 'getAll']);
    Route::get('/orders/{id}', [OrderController::class, 'detail']);
});

Route::group(['middleware' => ['role:courier'], 'prefix' => 'courier'], function () {
    Route::get('/orders/{id}', [OrderController::class, 'detail']);
});

/*Route::prefix('/orders')->group(function () {

    Route::get('/', ['uses' => 'OrderController@get']);
    Route::get('/{id}', ['uses' => 'OrderController@detail'])->where(['id' => '[0-9+]']);
    Route::post('/', ['uses' => 'OrderController@createOrder']);
    Route::delete('/{id}', ['uses' => 'OrderController@delete'])->where(['id' => '[0-9+]']);
    Route::put('/{id}', ['uses' => 'OrderController@updateOrder'])->where(['id' => '[0-9+]']);

});*/
