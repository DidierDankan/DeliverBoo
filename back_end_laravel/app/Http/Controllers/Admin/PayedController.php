<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Braintree\Transaction as Braintree_Transaction;


class PayedController extends Controller
{
    //

    public function make(Request $request)
{

    $payload = $request->input('payload', false);
    
    $status = Braintree_Transaction::sale([
        'amount' => '10.00',
        'options' => [
        'submitForSettlement' => True
        ]
    ]);

    return response()->json($status);
}

    public function payed()
    {


        $user_id = Auth::user()->id;

        $restaurant_ids = [];

        $restaurants = Restaurant::where('user_id', '=', $user_id)->get();

        foreach ($restaurants as $restaurant){
            array_push($restaurant_ids, $restaurant['id']);
        }

        $orders = Order::whereIn('restaurant_id', $restaurant_ids)->where('status', '=', 1)->paginate(6);

        if (!$orders) {
            return view('admin.errors.404error');
        }

        return view('admin.orders.index', compact('orders', 'restaurants'));

        // $user_id = Auth::user()->id;

        // $restaurants = Restaurant::where('user_id', '=', $user_id)->get();

        // $orders = Order::join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')->where('restaurants.user_id', '=', $user_id)->where('status', '=', 1)->paginate(6);
        
        // return view('admin/orders/payed', compact('orders', 'restaurants'));
    }
}
