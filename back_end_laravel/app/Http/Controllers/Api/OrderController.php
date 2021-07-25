<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Models\Food;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Order;
use App\Models\FoodOrder;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailDemo;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

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

    public function store_order(Request $request, Gateway $gateway){

        $all = $request->get('order');

        $array = json_decode($all, true, JSON_UNESCAPED_SLASHES);

        // $array->validate([
        //     'name' => ['required', 'max:50'],
        //     'surname' => ['required', 'max:50'],
        //     'email' => ['required','max:255'],
        //     'address' => ['required','max:255'],
        //     'phone' => ['required','max:20'],
        //     'city' => ['required','max:50'],
        //     'zip_code' => ['required', 'string', 'size:10', 'regex:/^(?:\d+|all)$/'],
        //     'status' => ['required'],
        //     'amount' => ['required', 'numeric'],
        // ]);
            
        
        $food = $array['food'];
        
        $restaurant = $food['restaurant_id'];
        
        $foods = $food['items'];
        
        $new_order = new Order();

        
        $new_order->transation_id = $array['transation'];
        

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


        

        // $success = true;

        // return response()->json($success);

        //transation to the sandbox account

        $order = Order::find($order_id);

        $result = $gateway->customer()->create([
            'firstName' => $order->customer_name,
            'lastName' => $order->customer_surname,
            'email' => $order->customer_mail,
            'phone' => $order->customer_phone,
        ]);
        
        $customer_id = $result->customer->id;

        $result = $gateway->transaction()->sale([
            'customerId' => $customer_id,
            'amount' => $order->amount,
            'paymentMethodNonce' => $order->transation_id,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        
        if($result->success) {
            $data = [
                'success' => true,
                'message' => 'Transaction was successful',
            ];
            
            $email = $order->customer_mail;
       
            $mailData = [
                'title' => 'Ordine n° ' . $order->id,
                'name' => $order->customer_name,
                'amount' => $order->amount,
                'url' => 'http://localhost:8080/#/'
            ];
      
            Mail::to($email)->send(new EmailDemo($mailData));

            return response()->json($data, 200);
           
        } else{
            $data = [
                'success' => false,
                'message' => 'Transaction failed',
            ];
            return response()->json($data, 401);
        }

    }

    

}
