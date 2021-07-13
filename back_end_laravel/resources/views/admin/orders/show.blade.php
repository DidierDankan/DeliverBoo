@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card w-50">
        <h1 class="card-header">Order details</h1>
        <div class="card-body">
            <div>Name: {{ $order->customer_name }}</div>
            <div>Surname: {{ $order->customer_surname }}</div>
            <hr>
            <div>Address: {{ $order->customer_address }}</div>
            <div>City: {{ $order->customer_city }}</div>
            <div>Zip Code: {{ $order->customer_zip_code }}</div>
            <hr>
            <div>Email: {{ $order->customer_mail }}</div>
            <div>Phone: {{ $order->customer_phone }}</div>
            <hr>
            <div>
                @foreach ($restaurants as $restaurant)
                    @if ($restaurant->id == $order->restaurant_id)
                        Restaurant: {{ $restaurant->name }}
                    @endif
                @endforeach
            </div>
            
            <div>Amount: {{ $order->amount }}€</div>
            <div>
               Status: {{ ($order->status == 1) ? 'Pagato' : 'Non Pagato' }}
            </div>

            <div class="actions mt-4">
                <a class="btn btn-info text-white mr-3" href=" {{ route('admin.home') }} ">Dashboard</a>
                <a class="btn btn-primary" href="{{ route('admin.orders.index') }}">Orders</a>
            </div>
        </div>
    </div>
</div>
@endsection