@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card w-50">
        <h1 class="card-header">Order details</h1>
        <div class="card-body">
            <div class="print">
                <div class="title-print">Order no: {{$order->id}} of: {{$order->created_at}}</div>
                <div>Transaction id: {{$order->transation_id}}</div>
                <hr>
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
                <hr>
                <div>
                    Details:
                    <ul>
                        @foreach ($vals as $key => $food)
                            <li>
                                <span>{{$key . ' ' . 'x'}}</span>  <span>{{' ' . $food . 'pz'}}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <hr>
                
                <div>Amount: {{ number_format($order->amount, 2) }}€</div>
                <div>
                   Status: {{ ($order->status == 1) ? 'Pagato' : 'Non Pagato' }}
                </div>
            </div>

            <div class="actions justify-content-center d-flex mt-4">
                <div>
                    <a class="btn btn-info text-white mr-3" href=" {{ route('admin.home') }} "><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </div>
                <div>
                    <a class="btn btn-primary mt-3 mt-md-0 mt-lg-0 mr-3" href="{{ route('admin.orders.index') }}"><i class="fas fa-list-ul"></i> Orders</a>
                </div>

                <div>
                    <button class="btn btn-primary mt-3 mt-md-0 mt-lg-0" onclick="window.print();return false;"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection