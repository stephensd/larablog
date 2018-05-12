@extends('layouts.app')
@section('content')

  <div class="container-fluid">
    <div class="jumbotron">
      <h1>{{ $category->name }}</h1>
    </div>
  </div>

  <div class="col-md-12">
    <div class="btn-group">
      <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-margin-right btn-sm white-text">Edit</a>

      <form class="" action="{{ route('categories.destroy', $category->id) }}" method="post">
        {{ method_field('delete') }}
            <button class="btn btn-danger btn-margin-right btn-sm white-text" type="submit" name="category_delete">Delete</button>
        {{ csrf_field() }}
      </form>
    </div>
    <hr>
    <div class="col-md-12">
      @foreach ($category->blog as $blog)
      <h2><a href="{{ route('blogs.show', [$blog->slug]) }}">{{ $blog->title }}</a></h2>
      <div class="lead">{!! str_limit($blog->body, 300) !!}</div>
      <hr>
      @if ($blog->user_id)
          Author: <a href="{{ route('users.show', $blog->user->slug) }}">{!! $blog->user->name !!}</a>
          | Posted: {{ $blog->created_at->diffForHumans() }}
          | Categories:
          @foreach ($blog->category as $category)
            <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>,
          @endforeach
      @endif
      <hr><br><br>
      @endforeach

    </div>
  </div>

@endsection
