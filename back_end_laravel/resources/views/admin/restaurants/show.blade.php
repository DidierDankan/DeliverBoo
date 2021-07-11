@extends('layouts.app')

@section('content')
<div class="container">
 
    <p>{{ $restaurant->name}}</p>
    <p>{{ $restaurant->address}}</p>
    <p>{{ $restaurant->city}}</p>
    <p>{{ $restaurant->zip_code}}</p>



    @foreach($foods as $food)

    {{$food->id}}
    {{$food->title}}
        
    <a class="btn btn-primary text-white mt-5" href="{{route('admin.foods.show', $food->id)}}">Piatto</a>
    @endforeach



    <div class="row">
        @if ($restaurant->cover)
            
        <div class="col-md-6">
            <img class="img-fluid" src="{{ asset('storage/' . $restaurant->cover)}}" alt="{{$restaurant->title}}">
        </div>
        @endif

        {{-- <div class="{{}}"> </div> --}}
    </div>


    <ul class="mt-5">
                
        @foreach ($types as $type)
        
            @if(! $errors->any() && $restaurant->types->contains($type->id))
                    <li>{{$type->type}}</li>    
            @endif

        @endforeach
    </ul>
  

</div>
@endsection