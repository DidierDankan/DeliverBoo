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

        $user_id = Auth::user()->id;
        
        $restaurant = Restaurant::where('user_id', '=', $user_id)->find($id);

        $types = ['Food','Drink','Souce'];

        return view('admin.foods.create', compact('restaurant', 'types'));
    }
}
