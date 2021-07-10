@extends('layouts.app')

@section('content')
    <div class="container">

      

        <h1>Our Restaurants</h1>
        

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Create</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurants as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name}}</td>
                        <td>@if($item->type) {{ $item->type}} @endif</td>
                        
                        <td><div>{{ $item->created_at->format('l d/m/y') }}</div>
                       <div> {{ $item->created_at->diffForHumans() }}</div>
                    </td>
                    
                        <td><a class="btn btn-success" href="{{ route('admin.restaurants.show' , $item->id) }}">SHOW</a></td>
                       
                        <td>
                            <form class="delete-post-form" action="{{ route('admin.restaurants.destroy', $item->id) }}" method="POST">
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
@endsection