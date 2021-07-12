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

        $restaurants = Restaurant::where('user_id', '=', $user_id)->get();


        // $restaurant_ids = [];


        // foreach ($restaurants as $restaurant){
        //     array_push($restaurant_ids, $restaurant->id);
        // }

        // dd($restaurant_ids);

        // $orders = Order::where('restaurant_id', '=', $user_id)->paginate(6);

        // foreach ($restaurant_ids as $restaurant_id){

        //     $orders = Order::where('restaurant_id', '=', $restaurant_id)->paginate(6);
        // }

        $orders = Order::join('restaurants', 'orders.restaurant_id', '=', 'restaurants.id')->where('restaurants.user_id', '=', $user_id)->paginate(6);

        // $orders = Order::select('restaurant_id', $restaurants['id'])
        
        // ->where('restaurant_id', '=', $restaurants)->paginate(6);

        // dd($orders);


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

        $restaurants = Restaurant::all();
        $order = Order::find($id);

        dd($order);

        return view('admin.orders.show', compact('order', 'restaurants'));

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
