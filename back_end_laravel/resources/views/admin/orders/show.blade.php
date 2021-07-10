@extends('layouts.app')

@section('content')
<div class="container">
    <div>{{ $order->customer_name }}</div>
    <div>{{ $order->customer_surname }}</div>
    <div>{{ $order->customer_address }}</div>
    <div>{{ $order->customer_city }}</div>
    <div>{{ $order->customer_zip_code }}</div>
    <div>{{ $order->customer_mail }}</div>
    <div>{{ $order->customer_phone }}</div>
    <div>
        @foreach ($restaurants as $restaurant)
            @if ($restaurant->id == $order->restaurant_id)
                {{ $restaurant->name }}
            @endif
        @endforeach
    </div>
    <div>{{ $order->amount }}</div>
    <div>
       {{ ($order->status == 1) ? 'Pagato' : 'Non Pagato' }}
    </div>
</div>
@endsection