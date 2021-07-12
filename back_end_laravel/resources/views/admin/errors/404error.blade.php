@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header">
                404 Not Found
            </h2>
            <p class="card-body">
                please dont play with the url
            </p>
            <a href=" {{ route('admin.restaurants.index') }} ">return to restaurants</a>
        </div>
    </div>
@endsection