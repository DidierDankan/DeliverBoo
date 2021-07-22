@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
        <div class="card shadow bg-white rounded mt-4">
             
                <h2 class="mb-3 card-header ">Edit Restaurant</h2>
                
                <div class="card-body">
                    <form action=" {{ route('admin.restaurants.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data" class="update-form">
                        @csrf
                        @method('PATCH')
            
                        <div class="mb-3">
                            <label for="name" class="form-label">Restaurant Name*:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $restaurant->name) }}"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            required
                            >
                            @error('name')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Adress*:</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $restaurant->address) }}"
                            name="address"
                            id="address"
                            value="{{ old('address') }}"
                            maxlength="255"
                            required
                            >
                            @error('address')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="address d-flex justify-content-between">
                            <div class="mb-5 w-50 mr-2">
                                <label for="city">City*:</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $restaurant->city) }}"
                                name="city"
                                id="city"
                                value="{{ old('city', $restaurant->city) }}"
                                maxlength="50"
                                required
                                >
                                @error('city')
                                    <div class="feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-5 w-50 ml-2">
                                <label for="zip_code">Zip Code*:</label>
                                <input type="text" class="form-control @error('zip_code') is-invalid @enderror" value="{{ old('zip_code', $restaurant->zip_code) }}"
                                name="zip_code"
                                id="zip_code"
                                value="{{ old('zip_code') }}"
                                maxlength="10"
                                required
                                >
                                @error('zip_code')
                                    <div class="feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div>
                                <label for="cover" class="form-label">Restaurant cover:</label>
                            </div>
                            @if ($restaurant->cover)      
                                <img width="200" class="mb-2" src=" {{ asset('storage/restaurants-covers/' . $restaurant->cover) }} " alt=" {{ $restaurant->title }} ">
                            @endif
            
                            <input type="file"  
                            name="cover" 
                            id="cover"
                            class="@error('cover') is-invalid @enderror" >
                            @error('cover')
                                <div class="mt-2 feedback alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <h5>Types: </h5>
                        <div class="mb-5 mt-3">
                            @foreach ($types as $type)
                            <span class="d-inline-block mr-3">
                                <input type="checkbox" name="types[]" id="type{{ $loop->iteration }}" value="{{ $type->id }}" 
                                @if ($errors->any() && in_array($type->id, old('types', []) )
                                  || (!$errors->any() && $restaurant->types->contains($type->id)))
                                  checked
                                @endif 
                                >
                                <label for="type{{ $loop->iteration }}"></label>
                                {{ $type->type }}
                            </span>
            
                            @endforeach
                            @error('types')
                                <div>{{$message}}</div>
                            @enderror
                           
                        </div>
            
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary mr-3">Update</button>
                            <a href="{{route('admin.restaurants.index')}}" class="btn btn-success text-white mr-3">Restaurants</a>
                            <a href="{{route('admin.restaurants.show', $restaurant->id)}}" class="btn btn-info text-white">Menu</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection