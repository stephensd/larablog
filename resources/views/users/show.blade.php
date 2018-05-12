@extends('layouts.app')

@section('content')

    <div class="container">
        <h3>{{ $user->name }}'s recent blogs</h3>
        <p>Role: {{ $user->role->name }}</p>
        <hr>
        @foreach ($user->blog as $blog)
            <h4><a href="{{ route('blogs.show', [$blog->slug]) }}">{{ $blog->title }}</a></h4>
            <p>Posted: {{ $blog->created_at->diffForHumans() }} | Categories:
              @foreach ($blog->category as $category)
                <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>,
              @endforeach
            </p>
            <hr>
        @endforeach
    </div>

@endsection
