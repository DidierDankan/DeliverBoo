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


Auth::routes();

Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
       
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


        //rotta resource food

        Route::resource('foods', FoodController::class);

        
        Route::resource('/restaurants', 'RestaurantController');

        Route::resource('/orders', 'OrderController');

    });

