@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Payed orders</h1>
    @foreach($orders as $order)

    {{$order->id}}
    @endforeach
</div>

@endsection