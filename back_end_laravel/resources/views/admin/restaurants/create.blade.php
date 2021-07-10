@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Creat a new Restaurant</h2>
    <a href=" {{ route('admin.restaurants.index') }} "><-- Go back to your Dashboard</a>
    <form action=" {{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
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

        <div class="mb-3">
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

        <div class="mb-3">
            <label for="zip_code">Zip Code:</label>
            <input type="number" class="form-control @error('zip_code') is-invalid @enderror" 
            name="zip_code" 
            id="zip_code"
            value="{{ old('zip_code') }}">    
            @error('zip_code')
                <div class="feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Restaurant cover:</label>
            <input type="file" class="form-control @error('cover') is-invalid @enderror" 
            name="cover" 
            id="cover" 
            >
            @error('cover')
                <div class="feedback">
                    {{$message}}
                </div>
            @enderror
        </div>


        <h4>Types</h4>
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
        </div>

        <button class="btn btn-primary">Create Post</button>
    </form>
</div>    
@endsection