@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
        <div class="card shadow bg-white rounded mt-4">
            
            
                <h2 class="mb-3 card-header">Edit: {{$food->title}}</h2>
            
                <div class="card-body">
                    <form action=" {{ route('admin.foods.update', $food->id) }}" method="POST" enctype="multipart/form-data" class="update-form">
                        @csrf
                        @method('PATCH')
            
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



                        <div class="mb-4 text-center">
                            <div class="form-label mb-3 {{$food->visibility ? 'alert-success' : 'alert-danger'}}">{{ $food->visibility ? 'This Food is currently available. Do you want change?' : 'This Food is not currently available. Do you want change?'}}</div>
                            <div class="bg-danger rounded w-25 d-inline-block pt-2">


                                <label for="visibility" class="form-label"><strong>Not available </strong></label>
                                <input style="vertical-align: middle;" type="radio" class=" ml-2 @error('visibility') is-invalid @enderror"
                                name="visibility"
                                id="visibility"
                                value ="0">
                            </div>
                            <div class="bg-success rounded w-25 d-inline-block pt-2">
                                <label for="visibility" class="form-label ml-3"><strong>Available </strong></label>
                                <input style="vertical-align: middle;" type="radio" class="ml-2 @error('visibility') is-invalid @enderror"
                                name="visibility"
                                id="visibility"
                                value ="1">
                            </div>
                        
                            @error('visibility')

                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        


                        <label class="mb-3" for="content">Description: </label>
    
        <textarea class="form-control mb-4"  name="content" id="description" placeholder="Write here..." cols="30" rows="5" >{{  $food->description }}</textarea>
        @error('description')
        <div class="feedback">{{$message}}</div>
        @enderror
        <div class="address d-flex justify-content-between">

                            {{-- <div class="mb-4 w-50 mr-2">
                                <label for="type" class="form-label">Type: </label>
                                <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $food->type) }}">
                                @error('type')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                
                                @enderror
                                
                            </div> --}}


                            <div class="mb-4 w-50 mr-2">
                                <label for="type" class="form-label">Type: </label>
                                {{-- <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror"> --}}
                            
                                <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                    <option value="{{$food->type}}">{{$food->type}}</option>
                                    @foreach($types as $type)
                                        @if($food->type != $type)
                                            <option value="{{$type}}">{{$type}}</option>
                                        @endif
                                    @endforeach 
                                </select>
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

                        {{-- <a class="btn btn-success text-white mr-3" href=" {{ route('admin.restaurants.index') }} ">Restaurants</a> --}}

                        <a class="btn btn-success text-white mr-3" href="{{ route('admin.restaurants.show' , $food->restaurant_id) }}">Menu</a>

                        <a class="btn btn-info text-white " href=" {{ route('admin.home') }} ">Dashboard</a>


                    </form>
                </div>
            </div>
        </div>
    </div>


</div>    
@endsection