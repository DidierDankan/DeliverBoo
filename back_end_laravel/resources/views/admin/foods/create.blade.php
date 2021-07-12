@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
        <div class="card shadow bg-white rounded mt-4">
            
            
                <h2 class="mb-3 card-header">Create a new Food</h2>
            
                <div class="card-body">
                    <form action=" {{ route('admin.foods.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
            
                        <div class="mb-4">
                            <label for="title" class="form-label">Food Name:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                            name="title"
                            id="title"
                            value=" {{ old('title') }} ">
                            @error('title')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>


                        <label class="mb-4" for="content">Description: </label>
    
        <textarea class="form-control"  name="description" id="description" placeholder="Write here..." cols="30" rows="5">{{old('description')}}</textarea>



                        {{-- <div class="mb-3">
                            <label for="address" class="form-label">Type:</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                            name="address"
                            id="type"
                            value="{{ old('type') }}"
                            >
                            @error('type')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div> --}}


                        <div class="mb-4 mt-4">
                            <label for="restaurant_id">Restaurant</label>
                            <select class="form-control" name="restaurant_id" id="restaurant_id">
                
                                <option value="">-- Select restaurant --</option>
                                @foreach ($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}" @if(old('restaurant_id') == $restaurant->id)selected @endif>{{ $restaurant->name }}</option>
                                @endforeach
                
                            </select>
                        </div>



                        <div class="address d-flex justify-content-between">

                            <div class="mb-4 w-50 mr-2">
                                <label for="type" class="form-label">Type: </label>
                                <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                @error('type')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                
                                @enderror
                                
                            </div>
                            
                            <div class="mb-4 w-50 ml-2">
                                <label for="price">Price:</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                name="price"
                                id="price"
                                value="{{ old('price') }}">
                                @error('price')
                                    <div class="feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-5 ">
                            <label for="ingredients">Ingredients:</label>
                            <input type="text" class="form-control @error('ingredients') is-invalid @enderror"
                            name="ingredients"
                            id="ingredients"
                            value="{{ old('ingredients') }}">
                            @error('ingredients')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
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