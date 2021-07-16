<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function generate(Request $request)
    {
        return 'generate';
    }
    public function make_payment(Request $request)
    {
        return 'meke payment';
    }

    // public function store(Request $request){

    //     $data = $request->all();
    //     dd($data);

    // }
}
