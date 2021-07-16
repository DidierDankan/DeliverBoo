<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();
        $data = [
            'token' => $token,
        ];
        return response()->json($data,200);
    }
    public function make_payment(Request $request, Gateway $gateway)
    {
        // $result = $gateway->transaction()->sale()
        // return ;
    }
}
