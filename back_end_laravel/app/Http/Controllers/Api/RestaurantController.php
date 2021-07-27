<?php

namespace App\Http\Controllers\Api;


use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Food;
use App\Models\Order;
use App\Models\Type;

class RestaurantController extends Controller
{
    //
    public function index() {

        $restaurants = Restaurant::with('types')->orderBy('created_at', 'DESC')->paginate(6);

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

    public function filterByType(Request $request) {

            $string = $request->get('list');

            $array = json_decode($string, true, JSON_UNESCAPED_SLASHES);
            
            $filtered_restaurants = [];

            $restaurants = Type::leftJoin('restaurant_type', 'types.id', '=', 'restaurant_type.type_id')->get();

            foreach($restaurants as $restaurant){

                if(in_array($restaurant['type'], $array)){
                    array_push($filtered_restaurants, $restaurant['restaurant_id']);
                }
            }

            $latest = Restaurant::with('types')->whereIn('id', $filtered_restaurants)->get();
            
            return response()->json($latest);
    }
}
