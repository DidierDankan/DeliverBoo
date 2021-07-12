<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class CreateFoodController extends Controller
{
    //

    public function create($id)
    {   

        
        // dd($test);
        
        $user_id = Auth::user()->id;
        
        $restaurant = Restaurant::where('user_id', '=', $user_id)->find($id);
        // $types = Type::all();
        
        // $restaurant = Restaurant::find($id);


        // return view('admin.restaurants.index', compact('restaurants', 'types'));

        return view('admin.foods.create', compact('restaurant'));
    }
}
