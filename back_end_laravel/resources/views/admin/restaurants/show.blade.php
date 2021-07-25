@extends('layouts.app')

@section('content')
<div class="container">  
 
    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card">
                <h3 class="card-header">Account</h3>
                <div class="card-body">
                    <strong>{{ $restaurant->name}}</strong>
                    <hr>
                    {{ $restaurant->address}}
                    
                    <div class="addres d-flex mt-4">
                        <div class="mr-4">{{ $restaurant->city }}</div>
                        
                        <div>{{ $restaurant->zip_code}}</div>
                    </div>
                    <hr>
                    <div>P.IVA {{$user->vat}}</div>
                    @if ($restaurant->cf) <div>CF: {{$user->cf}}</div> @endif
                </div>
            </div>
        </div>
        
            @if ($restaurant->cover)
        
            <div class="col-md-4 mb-3">
                <div class="card">
                    <h3 class="card-header">Cover</h3>
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
                <div class="card-header d-flex justify-content-between">
                    <h3>Menu</h3>

                    <div class="actions">
                        <a class="btn btn-info text-white mr-3" href=" {{ route('admin.home') }} "><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        <a class="btn btn-primary text-white" href=" {{ route('admin.foods.create', $restaurant->id) }} "><i class="far fa-plus-square"></i> New Food</a>
                    </div>
                </div>
                @if (session('deleted'))
                <div class="alert alert-success">
                    {{ session('deleted') }} is now deleted!
                </div>
                @endif
                <div class="table-container" style="overflow-x: scroll">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Food</th>
                                <th>Available</th>
                                <th>Price</th>
                                <th colspan="3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($foods as $food)
                            <tr>
                                    <td>{{$food->title}}</td>
                                    <td>{{($food->visibility) ? 'yes' : 'no'; }}</td>
                                    <td>{{number_format($food->price,2)}} €</td>
                                    <td>
                                        <a class="btn btn-success text-white" href="{{route('admin.foods.show', $food->id)}}"><i class="far fa-eye"></i> Details</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning" href="{{route('admin.foods.edit', $food->id)}}"><i class="far fa-edit"></i> Edit</a>
                                    </td>
                                    <td>
                                        <form class="delete-post-form" action="{{ route('admin.foods.destroy', $food->id) }}" method="POST">
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
                <div class="card-body d-flex justify-content-center align-items-md-center flex-column">
                    <div class="paginate mt-3 mr-3">
                        {{$foods->links()}}
                    </div>
                    <hr>
                    <h4 class="text-center">Restaurants controls:</h4>
                    <div class="actions d-flex justify-content-center mt-3">
                        <a class="btn btn-success text-white mr-3" href=" {{ route('admin.restaurants.index') }} "><i class="fas fa-utensils"></i> All</a>
                        <a class="btn btn-warning mr-3" href=" {{ route('admin.restaurants.edit', $restaurant->id) }} "><i class="far fa-edit"></i> Edit</a>
                        <form class="delete-post-form" action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" value="DELETE"><i class="far fa-trash-alt"></i> DELETE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection