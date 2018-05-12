@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="jumbotron">
        <h1>Trashed Blogs</h1>
    </div>
    <div class="col-md-12">
      @foreach ($trashedBlogs as $blog)
          <h2>{{ $blog->title }}</h2>
          <p>{!! $blog->body !!}</p>
              <div class="btn-group">
                  <!-- restore -->
                  <form method="get" class="" action="{{ route('blogs.restore', $blog->id) }}">
                      <button class="btn btn-success btn-xs btn-pull-left btn-margin-right" type="submit" name="btn_restore">Restore</button>
                  </form>
                  <!-- permanent Delete -->
                  <form method="get" class="" action="{{ route('blogs.permanent-delete', $blog->id) }}" method="post">
                      {{ method_field('delete') }}
                      <button class="btn btn-danger btn-xs btn-pull-left btn-margin-right" type="submit" name="btn_delete">Permanent Delete</button>
                  </form>
              </div>
      @endforeach
    </div>
</div>

@endsection
