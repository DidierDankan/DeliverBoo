@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header">
                404 Not Found
            </h2>
            <div class="card-body d-flex flex-column align-items-center">
               Hey {{Auth::user()->name}} please dont play with the url!!
               <a class="mt-4 btn btn-primary text-white" href=" {{ route('admin.home') }} ">Return to dashboard</a>
            </div>
        </div>
    </div>
@endsection