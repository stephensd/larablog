@extends('layouts.app')
@section('content')
@include('partials.tinymce')

<div class="container-fluid">

  <div class="jumbotron">
    <h1>Edit | {{ $blog->title }}</h1>
  </div>

  <div class="col-md-12">
    <form class="" action="{{ route('blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data">
      {{ method_field('patch') }}
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
      </div>
      <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" class="form-control my-editor">{!! old('body'), $blog->body !!}</textarea>
      </div>
      <div class="form-group form-check form-check-inline">
      <strong>{{ $blog->category->count() ? 'Current Categories:' : '' }} &nbsp;</strong>
        @foreach ($blog->category as $category)
          <input type="checkbox" name="category_id[]" value="{{ $category->id }}" class="form-check-input" checked>
          <label class="form-check-label btn-margin-right">{{ $category->name }}</label>
        @endforeach
        <strong>{{ $filtered->count() ? 'Available Categories:' : '' }} &nbsp;</strong>
          @foreach ($filtered as $category)
            <input type="checkbox" name="category_id[]" value="{{ $category->id }}" class="form-check-input">
            <label class="form-check-label btn-margin-right">{{ $category->name }}</label>
          @endforeach
      </div>
      <div class="form-group">
        <label class="btn btn-default">
          <span class="btn btn-outline btn-sm btn-info">Featured Image</span>
          <input type="file" name="featured_image" class="form-control" hidden>
          @if($blog->featured_image)
            <img src="/images/featured_image/{{ $blog->featured_image ? $blog->featured_image : ''}}" alt="{{ str_limit($blog->title, 50) }}" height="30px" width="30px">
          @endif
        </label>
      </div>
      <div class="form-group">
          <button class="btn btn-primary" type="submit">Update blog</button>
      </div>

      {{ csrf_field() }}
    </form>
  </div>

</div>

@endsection
