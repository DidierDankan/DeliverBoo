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


        $restaurants = Restaurant::paginate(6);


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

    // public function filter($collection){

    //     $types = Type::all();

    //     $restaurant = Restaurant::has('types', '')



    // }

    public function filterByType(Request $request) {

        // $restaurants = 'cazzi';
            $string = $request->get('list');

           
            $array = json_decode($string, true, JSON_UNESCAPED_SLASHES);
            
            // $new_string = stripslashes($string);

            // $array = explode(',', $string);


        //    get_magic_quotes_gpc() ? stripslashes($array) : $array;

            // if (get_magic_quotes_gpc($array)) { 
            //     $_GET    = array_map('addslashes', $_GET); 
            //     $_POST   = array_map('addslashes', $_POST); 
            //     $_COOKIE = array_map('addslashes', $_COOKIE); 
            // }


            // $array = ['Pizzeria', 'Giapponese'];

            // $array = $list;

            $filtered_restaurants = [];

            $restaurants = Type::leftJoin('restaurant_type', 'types.id', '=', 'restaurant_type.type_id')->get();

            foreach($restaurants as $restaurant){

                // if($restaurant['id'] != null){
                //     array_push($test, $restaurant['type']);
                // }

                if(in_array($restaurant['type'], $array)){
                    array_push($filtered_restaurants, $restaurant['restaurant_id']);
                }
            }

            
            // $latest = Restaurant::

            $latest = Restaurant::whereIn('id', $filtered_restaurants)->get();


            // $types = Type::all();
            
            return response()->json($latest);



    }

    
}
