@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card shadow bg-white rounded">
            <h1 class="card-header">Our Restaurants</h1>
            
            @if (session('deleted'))
            <div class="alert alert-success">
                {{ session('deleted') }} is now deleted!
            </div>
            @endif
            
            
            <div class="table-container" style="overflow-x: scroll">
                <table class="table p-4">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Create</th>
                            <th colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($restaurants as $restaurant)
                            <tr>
                                <td>{{ $restaurant->id }}</td>
                                <td>{{ $restaurant->name}}</td>
                                <td>
                                @foreach ($types as $type)
                                    @if(! $errors->any() && $restaurant->types->contains($type->id))
                                            {{$type->type}}
                                    @endif
                                @endforeach
                                </td>
                
                                <td><div>{{ $restaurant->created_at->format('l d/m/y') }}</div>
                               <div> {{ $restaurant->created_at->diffForHumans() }}</div>
                            </td>
                
                                <td><a class="btn btn-success" href="{{ route('admin.restaurants.show' , $restaurant->id) }}"><i class="far fa-eye"></i> SHOW</a></td>
                                <td><a class="btn btn-warning" href="{{ route('admin.restaurants.edit' , $restaurant->id) }}"><i class="far fa-edit"></i> EDIT</a></td>
                
                                <td>
                                    <form class="delete-post-form" action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
                
                                    @csrf
                                    @method('DELETE')
                
                                    <button class="btn btn-danger" type="submit" value="DELETE"><i class="far fa-trash-alt"></i> DELETE</button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-body d-flex justify-content-center align-items-md-center">
                <div class="paginate mt-3 mr-3">
                    {{$restaurants->links()}}
                </div>
                <a class="btn btn-info text-white mr-3" href=" {{ route('admin.home') }} "><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a class="btn btn-primary text-white" href=" {{ route('admin.restaurants.create') }} "><i class="far fa-plus-square"></i> Create New</a>
            </div>
        </div>
    </div>
@endsection