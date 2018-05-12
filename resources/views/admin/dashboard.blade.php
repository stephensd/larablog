@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="jumbotron">
        @if (Auth::user() && Auth::user()->role_id === 1)
            <h1>Admin Dashboard</h1>
        @elseif(Auth::user() && Auth::user()->role_id === 2)
            <h1>Author Dashboard</h1>
        @elseif(Auth::user() && Auth::user()->role_id === 3)
            <h1>Subscriber Dashboard</h1>
        @endif
    </div>

    @if (Auth::user() && Auth::user()->role_id === 1)
    <div class="col-md-12">
          <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-margin-right white-text">Create Blog</a>
          <a href="{{ route('admin.blogs') }}" class="btn btn-warning btn-margin-right white-text">Manage Blogs</a>
          <a href="{{ route('categories.create') }}" class="btn btn-success btn-margin-right white-text">Create Category</a>
          <a href="{{ route('blogs.trash') }}" class="btn btn-danger btn-margin-right white-text">Trashed Blog</a>
          <a href="{{ route('users.index') }}" class="btn btn-primary btn-margin-right white-text">Manage Users</a>
    </div>
    @elseif(Auth::user() && Auth::user()->role_id === 2)
    <div class="col-md-12">
          <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-margin-right white-text">Create Blog</a>
          <a href="{{ route('categories.create') }}" class="btn btn-success btn-margin-right white-text">Create Category</a>
    </div>
    @elseif(Auth::user() && Auth::user()->role_id === 3)
    <div class="col-md-12">
          <a href="{{ route('blogs') }}" class="btn btn-primary btn-margin-right white-text">Show Blog</a>
    </div>
    @endif

</div>

@endsection
