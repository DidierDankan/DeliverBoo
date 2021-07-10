@extends('layouts.app')

@section('content')
<div class="container">
    <h1>OUR ORDER</h1>
    
    <table class="table mt-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_surname }}</td>
                    <td><a class="btn btn-primary" href="{{ route('admin.orders.show', $order->id) }}">SHOW</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection