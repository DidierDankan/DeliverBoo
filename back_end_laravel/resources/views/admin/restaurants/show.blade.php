@extends('layouts.app')

@section('content')
<div class="container">
 
    <p>{{ $restaurant->name}}</p>
    <p>{{ $restaurant->address}}</p>
    <p>{{ $restaurant->city}}</p>
    <p>{{ $restaurant->zip_code}}</p>
  

</div>
@endsection