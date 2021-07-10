<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

use Illuminate\Support\Facades\Auth;

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

// Rotte autenticazione
Auth::routes();

// Rotte amministrazione 
// Dashboard post login
// Route::get('/admin', 'HomeController@index')->name('home');
Route::prefix('admin')
    //->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function()
    {
        //rotta home admin
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class, ['only'=>[
            'index', 'show',
        ]]);
        
        Route::get('restaurants', App\Http\Controllers\RestaurantController::class);


    });


