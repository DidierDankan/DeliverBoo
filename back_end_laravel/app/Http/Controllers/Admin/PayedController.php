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
    // $nonce = $payload['nonce'];
    // dd($request->input('payload', false));
    $status = Braintree_Transaction::sale([
                            'amount' => '10.00',
                            // 'title' => 'cheesburger',
                            // 'paymentMethodNonce' => $nonce,
                            'options' => [
                                       'submitForSettlement' => True
                                         ]
              ]);
    return response()->json($status);
}

    public function payed()
    {

        $user_id = Auth::user()->id;

        $restaurants = Restaurant::where('user_id', '=', $user_id)->get();

        // $restaurant_ids = [];

        // foreach ($restaurants as $restaurant){
        //     array_push($restaurant_ids, $restaurant->id);
        // }


        // foreach ($restaurant_ids as $restaurant_id){

        //     $orders = Order::where('restaurant_id', '=', $restaurant_id)->where('status', '=', 1)->paginate(6);
        // }

        // $orders_def = [];

        // foreach ($orders as $order){
        //     if($order->status == 1){
        //         array_push($orders_def, $order);
        //     }
        // }

        $orders = Order::join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')->where('restaurants.user_id', '=', $user_id)->where('status', '=', 1)->paginate(6);
        

        return view('admin/orders/payed', compact('orders', 'restaurants'));

    }

    // public function payed(){
    //     $orders = Order::where('status', '=', 1)->get();

    //     return view('admin/orders/payed', compact('orders'));
    // }
}
