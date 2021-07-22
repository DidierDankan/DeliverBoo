<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;

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

Route::namespace('Api')->group(function() {
    Route::get('/restaurants', 'RestaurantController@index');
    Route::get('restaurants/{id}', 'RestaurantController@show');

    Route::get('/filter', 'RestaurantController@filterByType');

    Route::get('orders/generate', [OrderController::class, 'generate']);
    Route::post('orders/payment', [OrderController::class, 'make_payment']);
    Route::get('orders/get', [OrderController::class, 'store_order']);

    Route::get('/types', 'TypeController@index');
});
