@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('css')
    <link href="/css/post.css" rel="stylesheet">
@endsection

@section('content')
    <div class="article center-block">
        <h1 class="text-center">{{ $post->title }}</h1>
        <h3 class="author text-center">
            By 
            <a href="{{ route('user.posts', ['id' => $post->user->id]) }}">
                {{ $post->user->name }}
            </a>
        </h3>

        @if(Auth::user() == $post->user)
            <a class="btn btn-default pull-right" role="button" href="{{ route('posts.edit', ['id' => $post->id]) }}">
                <i class="glyphicon glyphicon-edit"></i> 
                Edit
            </a>
        {{-- User has logged in and has not bought the post --}}
        @elseif(Auth::user() && !Auth::user()->hasPurchased($post))
            <a class="btn btn-default pull-right" role="button" href="{{ route('posts.purchase', ['id' => $post->id]) }}">
                Purchase for ${{ $post->price }}
            </a>
        @endif

        <div id="article-body">{{ $post->body }}</div>
    </div>
@endsection

@section('scripts')
    <script src="/js/marked.js"></script>
    <script>
        document.getElementById('article-body').innerHTML = 
            marked(document.getElementById('article-body').innerHTML);
    </script>
@endsection