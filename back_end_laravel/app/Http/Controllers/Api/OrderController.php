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

        $name = $array['name'];

        $food = $array['food'];
        
        $restaurant = $food['restaurant_id'];
        
        $foods = $food['items'];
        
        $i = 1;

        $associativo = [];

        foreach($foods as $food){
            array_push($associativo, [$i++=>$food]);
        }



        
       




        $new_order = new Order();

        if(array_key_exists('food', $array)){
            $new_order->foods()->attach($associativo);
        }

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

        // popolazione tabella pivot

        
        // $new_food_order = new FoodOrder();



        



        return response()->json($associativo);
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
