@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
        <div class="card shadow bg-white rounded mt-4">
            
            
                <h2 class="mb-3 card-header">Create a new Restaurant</h2>
            
                <div class="card-body">
                    <form action=" {{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data" class="create-new">
                        @csrf
                        @method('POST')
            
                        <div class="mb-3">
                            <label for="name" class="form-label">Restaurant Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            id="name"
                            value=" {{ old('name') }} ">
                            @error('name')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Adress:</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                            name="address"
                            id="address"
                            value="{{ old('address') }}"
                            >
                            @error('address')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="address d-flex justify-content-between">
                            <div class="mb-5 w-50 mr-2">
                                <label for="city">City:</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                name="city"
                                id="city"
                                value="{{ old('city') }}">
                                @error('city')
                                    <div class="feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-5 w-50 ml-2">
                                <label for="zip_code">Zip Code:</label>
                                <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                name="zip_code"
                                id="zip_code"
                                value="{{ old('zip_code') }}">
                                @error('zip_code')
                                    <div class="feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
            
                        <div class="mb-4">
                            <label for="cover" class="form-label">Image: </label>
                            <input type="file" name="cover" id="cover">
                            @error('cover')
                            <div class="feedback">
                                {{$message}}
                            </div>
            
                            @enderror
                            <hr>
                        </div>

                        <h5>Choose your restaurant types</h5>
                        <div class="mb-5 mt-3">
                            @foreach ($types as $type)
                                <span class="d-inline-block mr-4">
                                    <input type="checkbox" name="types[]" id="type{{ $loop->iteration }}" value="{{ $type->id }}"
                                    @if (in_array($type->id, old('types', []))) checked
            
                                    @endif
            
                                    >
                                    <label for="type{{ $loop->iteration }}">
                                        {{ $type->type }}
                                    </label>
                                </span>
            
                            @endforeach
                            @error('tags')
                                <div>{{$message}}</div>
                            @enderror
                            <hr>
                        </div>
            
                        <button class="btn btn-primary mr-3">Create</button>

                        <a class="btn btn-success text-white mr-3" href=" {{ route('admin.restaurants.index') }} ">Restaurants</a>

                        <a class="btn btn-info text-white " href=" {{ route('admin.home') }} ">Dashboard</a>


                    </form>
                </div>
            </div>
        </div>
    </div>


</div>    
@endsection