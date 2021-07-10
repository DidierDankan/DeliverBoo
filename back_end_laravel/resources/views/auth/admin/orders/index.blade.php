@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="mb-3">
            Orders Records
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Order ID
                    </th>
                    <th colspan = 5>
                        Order
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            {{ $order->id }}
                        </td>
                        <td>
                            {{ $order->costumer_name }}
                        </td>
                        <td>
                            {{ $order->customer_address }}
                        </td>
                        <td>
                            <a class="btn btn-primary" href=" {{ route('admin.orders.show', $order->id) }} ">
                                Show
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection