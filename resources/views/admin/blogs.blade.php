@extends('layouts.app')
@include('partials.meta_static')
@section('content')

<div class="container-fluid">
  <div class="jumbotron">
      <h1>Manage Blogs</h1>
  </div>
  <div class="row">
      <div class="col-md-6">
        <h3>Published Blogs</h3>
        <hr>
        @foreach ($publishedBlogs as $blog)
            <h2><a href="{{ route('blogs.show', [$blog->slug]) }}">{{ $blog->title }}</a></h2>
            <p>{!! str_limit($blog->body, 100) !!}</p>
            <hr>
            <form class="" action="{{ route('blogs.update', $blog->id) }}" method="post">
              {{ method_field('patch') }}
                <input type="checkbox" name="status" value="0" style="display:none;" checked hidden>
                <button type="submit" name="admin_draft" class="btn btn-warning btn-xs">Save as Draft</button>
              {{ csrf_field() }}
            </form>
            <hr>
        @endforeach
      </div>
      <div class="col-md-6">
        <h3>Draft Blogs</h3>
        <hr>
        @foreach ($draftBlogs as $blog)
            <h2><a href="{{ route('blogs.show', [$blog->id]) }}">{{ $blog->title }}</a></h2>
            <p>{!! str_limit($blog->body, 100) !!}</p>
            <hr>
            <form class="" action="{{ route('blogs.update', $blog->id) }}" method="post">
              {{ method_field('patch') }}
                <input type="checkbox" name="status" value="1" style="display:none;" checked hidden>
                <button type="submit" name="admin_draft" class="btn btn-success btn-xs">Publish Blog</button>
              {{ csrf_field() }}
            </form>
            <hr>
        @endforeach
      </div>
  </div>
</div>

@endsection
