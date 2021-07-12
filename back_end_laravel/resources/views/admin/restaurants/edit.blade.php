@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
        <div class="card shadow bg-white rounded mt-4">
            
            
                <h2 class="mb-3 card-header ">Edit Restaurant</h2>
                
            
                <div class="card-body">
                    <form action=" {{ route('admin.restaurants.update', $restaurant->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
            
                        <div class="mb-3">
                            <label for="name" class="form-label">Restaurant Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $restaurant->name) }}"
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
                            <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $restaurant->address) }}"
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
                                <input type="text" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $restaurant->city) }}"
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
                                <input type="text" class="form-control @error('zip_code') is-invalid @enderror" value="{{ old('zip_code', $restaurant->zip_code) }}"
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

                        <h5>Types: </h5>
                        <div class="mb-5 mt-3">
                            @foreach ($types as $type)
                            <span class="d-inline-block mr-3">
                                <input type="checkbox" name="types[]" id="type{{ $loop->iteration }}" value="{{ $type->id }}" 
                                @if ($errors->any() && in_array($type->id, old('types')))
                                  checked  
                                  @elseif (!$errors->any() && $restaurant->types->contains($type->id))
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
            
                        <button class="btn btn-primary mr-3">Update restaurant</button>

                     


                    </form>
                </div>
            </div>
        </div>
    </div>


</div>    
@endsection