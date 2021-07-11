<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class PayedController extends Controller
{
    //

    public function payed(){
        $orders = Order::where('status', '=', 1)->get();

        return view('admin/orders/payed', compact('orders'));
    }
}
