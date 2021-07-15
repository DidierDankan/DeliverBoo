<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\Food;

class RestaurantController extends Controller
{
    //
    public function index() {

        $restaurants = Restaurant::all();

        return response()->json($restaurants);
    }

    public function show($id) {
        if(Restaurant::find($id)) {

            $restaurant = Restaurant::with('types')->find($id);
            $foods = Food::where('restaurant_id', '=', $restaurant->id)->get();
            $obj_food_restaurant = [$restaurant, $foods];
        }else {
            $obj_food_restaurant = 'not found';
        }

        

        return response()->json($obj_food_restaurant);
    }
}
