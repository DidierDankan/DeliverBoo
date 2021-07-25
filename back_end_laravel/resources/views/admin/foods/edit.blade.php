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
                            <label for="title" class="form-label">Food Name*:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $food->title) }}"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
                            maxlength="100"
                            required
                            >
                            @error('title')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>


                        

                        <div class="mb-4 text-center">
                            <h4>Available</h4>
                            <div id="message-visibility" class="form-label mb-3 {{$food->visibility ? 'alert-success' : 'alert-danger'}}">{{ $food->visibility ? 'This Food is currently available. Is it still available?' : 'This Food is currently unavailable. Is it available now?'}}</div>
                            
                            <div class=" bg-danger rounded w-25 d-inline-block pt-2">
                                <label for="visibility" class="form-label"><strong>NO </strong></label>
                                <input style="vertical-align: middle;" type="radio" class="radius ml-2 @error('visibility') is-invalid @enderror"
                                name="visibility"
                                id="visibility"
                                value ="0">
                            </div>

                            <div class=" bg-success rounded w-25 d-inline-block pt-2">
                                <label for="visibility" class="form-label ml-3"><strong>YES </strong></label>
                                <input style="vertical-align: middle;" type="radio" class="radius ml-2 @error('visibility') is-invalid @enderror"
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

                        <label class="mb-3" for="description">Description: </label>
    
                        <textarea class="form-control mb-4"  name="description" id="description" placeholder="Write here..." cols="30" rows="5" >{{  $food->description }}</textarea>
                        @error('description')
                        <div class="feedback">{{$message}}</div>
                        @enderror

                    <div class="address d-flex justify-content-between">   
                        <div class="mb-4 w-100 ml-2">
                            <label for="price">Price*:</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $food->price) }}"
                            name="price"
                            id="price"
                            value="{{ old('price') }}"
                            required>
                            @error('price')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                        <div class="mb-4">
                            <label for="ingredients">Ingredients*:</label>
                            <input type="text" class="form-control @error('ingredients') is-invalid @enderror" value="{{ old('ingredients', $food->ingredients) }}"
                            name="ingredients"
                            id="ingredients"
                            value="{{ old('ingredients') }}"
                            required>
                            @error('ingredients')
                                <div class="feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div>
                                <label for="cover" class="form-label">Food cover:</label>
                            </div>
                            @if ($food->cover)      
                                <img width="200" class="mb-2" src=" {{ asset('storage/foods-covers/' . $food->cover) }} " alt=" {{ $food->title }} ">
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
            
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary mr-3"><i class="fas fa-pen-alt"></i> Update</button>
                            <a class="btn btn-success text-white mr-3" href="{{ route('admin.foods.show' , $food->id) }}"><i class="fas fa-arrow-circle-left"></i> Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection