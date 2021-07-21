<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Models\Food;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Order;
use App\Models\FoodOrder;


class OrderController extends Controller
{
    public function generate(Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();
        $data = [
            'success' => true,
            'token' => $token,
        ];
        return response()->json($data,200);
    }

    public function store_order(Request $request){

        $all = $request->get('order');

        $array = json_decode($all, true, JSON_UNESCAPED_SLASHES);


        $food = $array['food'];
        
        $restaurant = $food['restaurant_id'];
        
        $foods = $food['items'];
        
        $new_order = new Order();

        $new_order->customer_name = $array['name'];

        $new_order->customer_surname = $array['surname'];

        $new_order->customer_mail = $array['email'];

        $new_order->customer_address = $array['address'];

        $new_order->customer_phone = $array['phone'];

        $new_order->customer_city = $array['city'];

        $new_order->customer_zip_code = $array['zip_code'];

        $new_order->status = $array['status'];

        $new_order->amount = $array['amount'];

        $new_order->restaurant_id = $restaurant;

        $new_order->save();

        $order_id = $new_order->id;

        // popolazione tabella pivot
 
        
        
        foreach ($foods as $food){
            
            $new_food_order = new FoodOrder();
            
            $new_food_order->order_id = $order_id;
            $new_food_order->food_id = $food;

            $new_food_order->save();
        }



        $success = true;


        return response()->json($success);

    }



    // public function make_payment(OrderRequest $request, Gateway $gateway)
    // {
    //     $food = Food::find($request->food);
    //     $result = $gateway->transaction()->sale([
    //         'amount' => $food->price,
    //         'paymentMethodNonce' => $request->token,
    //         'options' => [
    //             'submitForSettlement' => true,
    //         ],
    //     ]);

    //     if($result->success) {
    //         $data = [
    //             'success' => true,
    //             'message' => 'Transaction was successful',
    //         ];
    //         return response()->json($data, 200);
    //     } else{
    //         $data = [
    //             'success' => false,
    //             'message' => 'Transaction failed',
    //         ];
    //         return response()->json($data, 401);
    //     }
    //     // return ;
    // }
}
