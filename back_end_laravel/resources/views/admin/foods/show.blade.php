@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-md-center">
    <div class="card w-50">
        <h1 class="card-header">Food</h1>
        
        <div class="card-body">
            
                <div><strong>{{$food->title}}</strong></div>
                <hr>
                <div class="mb-3">{{$food->description}}</div>
                <div class="mb-3">Type: {{$food->type}}</div>
                <div class="mb-3">Avaible: {{$food->visibility ? 'yes' : 'no';}}</div>
                <div class="mb-3">
                    Ingredients:
                    <ul class="mt-3">
                        <li>{{$food->ingredients}}</li>
                    </ul>
                </div>

                <div class="actions">
                    <a class="btn btn-info text-white mr-3" href=" {{ route('admin.home') }} ">Dashboard</a>
                    <a class="btn btn-primary" href="{{ route('admin.restaurants.show', $food->restaurant_id) }}">MENU</a>
                </div>

            
        </div>
    </div>
</div>

@endsection