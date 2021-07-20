<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Models\Food;
use Illuminate\Http\Request;
use Braintree\Gateway;

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

        return response()->json($array);
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
