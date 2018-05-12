@extends('layouts.app')
@section('content')

<div class="container-fluid">
  <div class="jumbotron">
    <h1>Categories</h1>
  </div>
</div>

<div class="col-md-12">

  @foreach ($categories as $category)
      <h2><a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a></h2>
      <hr>
  @endforeach

</div>

@endsection
