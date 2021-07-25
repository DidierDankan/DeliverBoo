@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card">
                <h1 class="card-header">Food</h1>
            
                <div class="card-body">
                    <h3>{{$food->title}}</h3>
                    <hr>
                    <div class="mb-3">{{$food->description}}</div>
                    <hr>
                    <div class="mb-3">Type: {{$food->type}}</div>
                    <div class="mb-3">Available: <h4 class="d-inline-block badge p-1 {{$food->visibility ? 'badge-success' : 'badge-danger'}}">{{$food->visibility ? 'YES' : 'NO';}}</h4></div>
                    <div class="mb-3">
                        Ingredients:
                        <ul class="mt-3 mb-3">
                            <li>{{$food->ingredients}}</li>
                        </ul>
                    </div>
                    @if ($food->cover)
                        <hr>
                        Cover:
                        <div class="w-50 m-auto mb-3">
                            <img class="img-fluid" src="{{ asset('storage/foods-covers/' . $food->cover)}}" alt="{{$food->title}}">
                        </div>
                        <hr>
                    @endif
                    <div class="mb-4">Price: <span class="ml-2 d-inline-block rounded p-1 bg-success text-white fw-bold">{{number_format($food->price, 2)}} €</span></div>
                    <hr>
                    <div class="actions d-flex justify-content-center">
                        <a class="btn btn-primary mr-3" href="{{ route('admin.restaurants.show', $food->restaurant_id) }}"><i class="fas fa-bars"></i> Menu</a>
                        <a class="btn btn-warning mr-3" href="{{ route('admin.foods.edit', $food->id) }}"><i class="far fa-edit"></i> Edit</a>
                        <form class="delete-post-form" action="{{ route('admin.foods.destroy', $food->id) }}" method="POST">
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