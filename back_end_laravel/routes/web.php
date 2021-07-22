<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;




use App\Http\Controllers\Admin\FoodController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment', function () {
    return view('payment_test');
});

Auth::routes();

Route::prefix('admin')
->namespace('Admin')
->middleware('auth')
->name('admin.')
->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 
    Route::get('/orders/payed', 'PayedController@payed')->name('payed');
    Route::get('/foods/create/{id}', 'CreateFoodController@create')->name('foods.create');
    Route::get('/payment/make', 'PayedController@make')->name('payment.make');
        
    //rotta resource food
    Route::resource('/foods', 'FoodController', ['except' => 'create']);   
    Route::resource('/restaurants', 'RestaurantController');
    Route::resource('/orders', 'OrderController');
    });

    Route::get('{any?}', function () {
        return view('welcome');
    })->where("any", ".*");

