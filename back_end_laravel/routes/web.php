<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
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

// Rotte autenticazione
Auth::routes();

// Rotte amministrazione 
// Dashboard post login
// Route::get('/admin', 'HomeController@index')->name('home');
Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function()
    {
        //rotta home admin
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        //rotta resource food

        Route::resource('foods', FoodController::class);
    });


