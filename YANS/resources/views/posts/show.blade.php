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
        <h3 class="author text-center">By {{ $post->user->name }}</h3>
        
        <div id="article-body">{{ $post->body }}</div>
    </div>
@endsection

@section('scripts')
    <script src="/js/marked.js"></script>
    <script>
        marked.setOptions
        document.getElementById('article-body').innerHTML = 
            marked(document.getElementById('article-body').innerHTML);
    </script>
@endsection