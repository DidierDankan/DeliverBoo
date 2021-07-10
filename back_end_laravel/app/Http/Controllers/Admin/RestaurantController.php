<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    //
    public function index() {

        $restaurant = Restaurant::all();

        return view('auth.admin.restaurants.index', compact('restaurant'));
    }
}
