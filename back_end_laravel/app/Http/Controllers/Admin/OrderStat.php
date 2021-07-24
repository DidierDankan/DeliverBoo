<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderStat extends Controller
{
    //
    public function stats(){

        $user_id = Auth::user()->id;

        $restaurant_ids = [];

        $restaurants = Restaurant::where('user_id', '=', $user_id)->get();

        foreach($restaurants as $restaurant){
            array_push($restaurant_ids, $restaurant->id);
        }

        // $orders = Order::whereIn('restaurant_id', $restaurant_ids)->groupBy('created_at')->get();
        

        
        $orders = Order::whereIn('restaurant_id', $restaurant_ids)->select(
            DB::raw('sum(amount) as sums'), 
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
            )
            ->where('status', '=', 1)
            ->groupBy('months')
            ->get();
            // dd($orders);

        return response()->json($orders);
        // return view('admin/orders/stats', compact('orders'));



    }
}
