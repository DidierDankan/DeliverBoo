@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="mb-3">
            <h1>My Restaurants</h1>
    
            <a class="btn btn-warning" href="{{ route('admin.restaurants.create') }}">Add Restaurant</a>
        </div>

        <div class="deleted">
            @if(session('deleted')) 
                <div class="alert alert-success">
                    <strong> {{ session('deleted') }} </strong>
                </div>
            @endif
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                       Name
                    </th>
                    
                    <th>
                        city
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurants as $restaurant)
                    <tr>
                        <td>
                            {{ $restaurant->id }}
                        </td>
                        <td>
                            {{ $restaurant->name }}
                        </td>
                        <td>
                            {{ $restaurant->city }}
                        </td>
                        <td>
                           <p>
                            {{ $restaurant->created_at->format('d/m/y') }}
                            </p>
                            {{ $restaurant->created_at->diffForHumans() }}
                        </td>
                        <td>
                            <a class="btn btn-primary" href=" {{ route('admin.restaurants.show', $restaurant->id) }} ">
                                Show
                            </a>
                        </td>
                        <td>
                            
                        </td>
                        <td>
                            <form class="deleted" action=" {{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
    
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <div class="mt-2">
            <h2>
                Posts By Category:
            </h2>
            @foreach ($categories as $category)
                <h4 class="mt-2">
                    {{ $category->name }}:
                </h4>
                @forelse ($category->posts as $post)
                    <ul>
                        <li>
                            <a href=" {{ route('admin.posts.show', $post->id) }} "> {{ $post->title }}</a>
                        </li>
                    </ul>
                    @empty
                       No post for this category. <a href="{{ route('admin.posts.create') }}"> Create a new post</a>     
                    @endforelse
                @endforeach
        </div> --}}
    </div>
    
@endsection