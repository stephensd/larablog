@extends('layouts.app')
@section('content')
@include('partials.tinymce')

<div class="container-fluid">

  <div class="jumbotron">
    <h1>Create a new blog</h1>
  </div>

  <div class="col-md-12">
    <form class="" action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">

      @include('partials.error-message')

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control">
      </div>
      <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" class="form-control my-editor">{!! old('body') !!}</textarea>
      </div>
      <div class="form-group form-check form-check-inline">
        @foreach ($categories as $category)
          <input type="checkbox" name="category_id[]" value="{{ $category->id }}" class="form-check-input">
          <label class="form-check-label btn-margin-right">{{ $category->name }}</label>
        @endforeach
      </div>
      <div class="form-group">
        <label class="btn btn-default">
          <span class="btn btn-outline btn-sm btn-info">Featured Image</span>
          <input type="file" name="featured_image" class="form-control" hidden>
        </label>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" type="submit">Create a new blog post</button>
      </div>
      {{ csrf_field() }}
    </form>
  </div>

</div>

@endsection
