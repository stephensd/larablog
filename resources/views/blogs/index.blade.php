@extends('layouts.app')
@include('partials.meta_static')
@section('content')

<div class="container">

  @if (Session::has('blog_created_message'))
    <div class="alert alert-success">
      {{ Session::get('blog_created_message') }}
      <button type="button" name="post_success" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </div>
  @endif

  @if (Session::has('contact_form_send'))
    <div class="alert alert-success">
      {{ Session::get('contact_form_send') }}
      <button type="button" name="post_success" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </div>
  @endif

  @foreach ($blogs as $blog)

    <div class="row">
        <!-- dynamic page styling-->
        @if($blog->featured_image)
          <div class="col-md-8">
        @else
          <div class="col-md-12">
        @endif

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
        </div>

          @if($blog->featured_image)
          <div class="col-md-4">
              <img src="/images/featured_image/{{ $blog->featured_image ? $blog->featured_image : ''}}" alt="{{ str_limit($blog->title, 50) }}" class="img-responsive featured_image" style="width:300px; height:auto;">
          </div>
          @endif


    </div>

  @endforeach
</div>

@endsection
