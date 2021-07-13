@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-sm-10">
            <div class="card shadow bg-white rounded mt-4">
            
            
                <h2 class="mb-3 card-header">Create a new Food in: {{' ' . $restaurant->name}}</h2>
            
                <div class="card-body">
                    <form action="{{ route('admin.foods.store') }}" method="POST" enctype="multipart/form-data" class="create-new">
                        @csrf
                        @method('POST')
            
                        <div class="mb-4">
                            <label for="title" class="form-label">Food Name*:</label>
                            <input type="text" class="form-control @error ('title') is-invalid @enderror"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
                            placeholder="Name here.."
                            required
                            >
                            @error('title')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-4 text-center">
                            <h5>Available</h5>
                            <div class="bg-danger rounded w-25 d-inline-block pt-2">
                                <label for="visibility" class="form-label"><strong>NO </strong></label>
                                <input style="vertical-align: middle;" type="radio" class=" ml-2 @error('visibility') is-invalid @enderror"
                                name="visibility"
                                id="visibility"
                                value ="0">
                            </div>
                            <div class="bg-success rounded w-25 d-inline-block pt-2">
                                <label for="visibility" class="form-label ml-3"><strong>YES </strong></label>
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

                        <div class="mb-4">
                            <label class="mb-4" for="description">Description: </label>
                                
                            <textarea class="form-control"  name="description" id="description" placeholder="Write here..." cols="30" rows="5"></textarea>
                        </div>


                        <div style="display: none;" class="mb-4 mt-4">
                            <label for="restaurant_id"></label>
                            
                            <input  type="text" name="restaurant_id" id="restaurant_id" value="{{$restaurant->id }}" class="form-control @error('restaurant_id') is-invalid @enderror">
                                @error('restaurant_id')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                
                                @enderror
                        
                        </div>




                        <div class="address d-flex justify-content-between">

                            <div class="mb-4 w-50 mr-2">
                                <label for="type" class="form-label">Type*: </label>
                                <select 
                                    name="type" 
                                    id="type" 
                                    class="form-control 
                                    @error('type') is-invalid @enderror" 
                                    required>
                                    <option value="">-- Select Type --</option>
                                    @foreach($types as $type)
                                        <option value="{{$type}}">{{$type}}</option>
                                    @endforeach 
                                </select>
                                @error('type')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            
                                @enderror
                                
                            </div>
                            
                            <div class="mb-4 w-50 ml-2">
                                <label for="price">Price*:</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror"
                                name="price"
                                id="price"
                                value="{{ old('price') }}"
                                required
                                placeholder="Price.. es: 1.0"
                                >
                                @error('price')
                                    <div class="feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-5 ">
                            <label for="ingredients">Ingredients*:</label>
                            <input type="text" class="form-control @error('ingredients') is-invalid @enderror"
                            name="ingredients"
                            id="ingredients"
                            value="{{ old('ingredients') }}"
                            required
                            placeholder="Ingredients here..">
                            @error('ingredients')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
            
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary mr-3">Create</button>
                            <a class="btn btn-success text-white" href=" {{ route('admin.restaurants.index') }} ">Restaurants</a>
                        </div>

                        {{-- <a class="btn btn-info text-white " href=" {{ route('admin.home') }} ">Dashboard</a> --}}

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>    
@endsection