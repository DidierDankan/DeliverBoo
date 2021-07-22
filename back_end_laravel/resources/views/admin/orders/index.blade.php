@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <h1 class="card-header">All Orders</h1>

        <div class="table-container" style="overflow-x: scroll">
        
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>Order No</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Date</th>
                    <th>Restaurant</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->customer_surname }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            @foreach ($restaurants as $restaurant)
                                @if($restaurant->id == $order->restaurant_id)
                                    {{$restaurant->name}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$order->status ? 'Payed' : 'Not Payed'}}</td>
                        <td>{{ number_format($order->amount, 2) }}€</td>

                        <td><a class="btn btn-primary" href="{{ route('admin.orders.show', $order->id) }}">SHOW</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>
    <div class="card">
        <div class="card-body d-flex justify-content-center align-items-md-center">
            <div class="paginate mt-3 mr-3">
                {{$orders->links()}}
            </div>
            <div class="mt-3 mt-md-0 mt-lg-0 ">
            <a class="btn btn-info text-white mr-3" href="{{route('admin.home')}}">Dashboard</a>
        </div>
        <div class="mt-3  mt-md-0 mt-lg-0">
            <a class="btn btn-success text-white" href="{{route('admin.payed')}} ">Payed</a>
            <div>
        </div>
    </div>
</div>
@endsection