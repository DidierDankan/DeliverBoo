<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

use App\Models\Restaurant;


use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $restaurant_ids = [];

        $restaurants = Restaurant::where('user_id', '=', $user_id)->get();

        foreach ($restaurants as $restaurant){
            array_push($restaurant_ids, $restaurant['id']);
        }

        $orders = Order::whereIn('restaurant_id', $restaurant_ids)->paginate(6);

        

        return view('admin.orders.index', compact('orders', 'restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   

        $user_id = Auth::user()->id;

        $restaurant_ids = [];

        $restaurants = Restaurant::where('user_id', '=', $user_id)->get();

        foreach ($restaurants as $restaurant){
            array_push($restaurant_ids, $restaurant['id']);
        }

        $order = Order::with('foods')->whereIn('restaurant_id', $restaurant_ids)->find($id);

        $food_ids = [];

        foreach ($order->foods as $food){
            array_push($food_ids, $food['title']);
        }
        
        $vals = array_count_values($food_ids);



        // dd($vals);


        if (!$order) {
            return view('admin.errors.404error');
        }

        return view('admin.orders.show', compact('order', 'restaurants', 'vals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
