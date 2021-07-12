@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
        <div class="card shadow bg-white rounded mt-4">
            
            
                <h2 class="mb-3 card-header">Edit Food</h2>
            
                <div class="card-body">
                    <form action=" {{ route('admin.foods.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
            
                        <div class="mb-4">
                            <label for="title" class="form-label">Food Name:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $food->title) }}"
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
    
        <textarea class="form-control"  name="content" id="description" placeholder="Write here..." cols="30" rows="5" >{{ old('description', $food->description) }}</textarea>
        @error('description')
        <div class="feedback">{{$message}}</div>
        @enderror
        <div class="address d-flex justify-content-between">

                            <div class="mb-4 w-50 mr-2">
                                <label for="type" class="form-label">Type: </label>
                                <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $food->type) }}">
                                @error('type')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                
                                @enderror
                                
                            </div>
                            
                            <div class="mb-4 w-50 ml-2">
                                <label for="price">Price:</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $food->price) }}"
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
                            <input type="text" class="form-control @error('ingredients') is-invalid @enderror" value="{{ old('ingredients', $food->ingredients) }}"
                            name="ingredients"
                            id="ingredients"
                            value="{{ old('ingredients') }}">
                            @error('ingredients')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
            
                        

                        
            
                        <button class="btn btn-primary mr-3">Update</button>

                        <a class="btn btn-success text-white mr-3" href=" {{ route('admin.restaurants.index') }} ">Restaurants</a>

                        <a class="btn btn-info text-white " href=" {{ route('admin.home') }} ">Dashboard</a>


                    </form>
                </div>
            </div>
        </div>
    </div>


</div>    
@endsection