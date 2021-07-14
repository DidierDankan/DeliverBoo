<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\Food;
use App\Models\Order;

class RestaurantController extends Controller
{
    //
    public function index() {

        $restaurants = Restaurant::paginate(2);

        return response()->json($restaurants);
    }

    public function show($id) {
        if(Restaurant::find($id)) {

            $restaurant = Restaurant::find($id)->with('types')->first();
            $foods = Food::where('restaurant_id', '=', $restaurant->id)->get();
            $obj_food_restaurant = [$restaurant, $foods];
        }else {
            $obj_food_restaurant = 'not found';
        }

        

        return response()->json($obj_food_restaurant);
    }

    
}
