@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mt-4 row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-white rounded">
                <div class="font-weight-bold card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ 'Welcome ' . Auth::user()->name . '! This is your management page.' }}
                </div>
            </div>
            
        </div>
    </div>


    <div class="row mt-5 justify-content-center">
        <div class="col-md-6">
            <div class="card shadow bg-white rounded mb-5">
                <div class="font-weight-bold card-header">{{ __('Restaurant manager') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center mt-5 mb-5">
                        <a href="{{route('admin.restaurants.index')}}" class="btn btn-primary btn-lg text-white m-2"><i class="fas fa-utensils"></i> My Restaurants</a>
                        <a href="{{route('admin.restaurants.create')}}" class="btn btn-success btn-lg text-white m-2"><i class="far fa-plus-square"></i> Add Restaurant</a>
                    </div>

                </div>
            </div>
        </div>

        

        <div class="col-md-6">
            <div class="card shadow bg-white rounded">
                <div class="font-weight-bold card-header">{{ __('Orders Manager') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center mt-5 mb-5">
                        <a href="{{route('admin.orders.index')}}" class="btn btn-primary text-white m-2 btn-lg"><i class="fas fa-list-ul"></i> My Orders</a>
                        <a href="{{route('admin.payed')}}" class="btn btn-success text-white m-2 btn-lg"><i class="fas fa-check"></i> Payed</a>
                    </div>
                </div>
            </div>
            
        </div>

    </div>

    <div class="row">
        <div class="col-md-12 mt-5 mb-5">
            <div class="card shadow bg-white rounded">

                <canvas id="myChart" width="768" height="200" style="display: block; box-sizing: border-box; height: 200px; width: 768px;"></canvas>

            </div>

        </div>
    </div>


</div>




@endsection
