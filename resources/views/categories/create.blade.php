@extends('layouts.app')
@section('content')

<div class="container-fluid">

  <div class="jumbotron">
    <h1>Create a category</h1>
  </div>

  <div class="col-md-12">
    <form class="" action="{{ route('categories.store') }}" method="post">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control">
      </div>
      <button class="btn btn-primary" type="submit">Create a new Category</button>
      {{ csrf_field() }}
    </form>
  </div>
  <br><hr>
  @foreach ($categories as $category)
      <h2><a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a></h2>
      <hr>
  @endforeach

</div>

@endsection
