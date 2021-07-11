@extends('layouts.app')

@section('content')
<div class="container">

    
 
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <h3 class="card-header">Anagrafica</h3>
                <div class="card-body">
                    <strong>{{ $restaurant->name}}</strong>
                    <hr>
                    {{ $restaurant->address}}
                    
                    <div class="addres d-flex mt-4">
                        <div class="mr-4">{{ $restaurant->city }}</div>
                        
                        <div>{{ $restaurant->zip_code}}</div>
                    </div>
                </div>
            </div>
        </div>
        
            @if ($restaurant->cover)
        
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header">Immagine</h3>
                    <div class="card-body">
                        <img class="img-fluid" src="{{ asset('storage/restaurants-covers/' . $restaurant->cover)}}" alt="{{$restaurant->name}}">
                    </div>
                </div>
            </div>
        
            @endif
            
            @if (count($restaurant->types) > 0)
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header">Types</h3>
                    <div class="card-body">
                        <ul class="mt-1">
                            @foreach ($types as $type)
                
                                @if(! $errors->any() && $restaurant->types->contains($type->id))
                                        <li>{{$type->type}}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

    </div>



    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">Menu</h3>

                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>Food</th>
                            <th>Type</th>
                            <th>Available</th>
                            <th>Price</th>
                            <th colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($foods as $food)
                        <tr>
                                <td>{{$food->title}}</td>
                                <td>{{$food->type}}</td>
                                <td>{{($food->visibility) ? 'yes' : 'no'; }}</td>
                                <td>{{$food->price}}</td>
                                <td>
                                    <a class="btn btn-success text-white" href="{{route('admin.foods.show', $food->id)}}">Details</a>
                                    {{-- <a class="btn btn-primary text-white" href="{{route('admin.foods.show', $food->id)}}">Piatto</a>

                                    <a class="btn btn-primary text-white" href="{{route('admin.foods.show', $food->id)}}">Piatto</a> --}}

                                </td>
                                <td>
                                    <a class="btn btn-primary text-white" href="{{route('admin.foods.show', $food->id)}}">Edit</a>
                                </td>
                                <td>
                                    <form class="delete-post-form" action="{{ route('admin.foods.destroy', $food->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                
                                    <input class="btn btn-danger" type="submit" value="DELETE">
                                </form>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                
            </div>
            <div class="card">
                <div class="card-body d-flex justify-content-center align-items-md-center">
                    <div class="paginate mt-3 mr-3">
                        {{$foods->links()}}
                    </div>
                    <a class="btn btn-info text-white mr-3" href=" {{ route('admin.home') }} ">Dashboard</a>
                    <a class="btn btn-primary text-white" href=" {{ route('admin.foods.create') }} ">Add New</a>
    
                </div>
            </div>
        </div>
    </div>



    
  

</div>
@endsection