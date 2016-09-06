@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('css')
    <link href="/css/post.css" rel="stylesheet">
@endsection

@section('content')
    <div class="main">
        <h1>{{ $post->title }}</h1>
        <h2>By {{ $post->user->name }}</h2>
        
        <div id="article-body">{{ $post->body }}</div>
    </div>
@endsection

@section('scripts')
    <script src="/js/marked.js"></script>
    <script>
        document.getElementById('article-body').innerHTML = 
            marked(document.getElementById('article-body').innerHTML);

            marked.setOptions({
              renderer: new marked.Renderer(),
              gfm: false,
              tables: true,
              breaks: false,
              pedantic: false,
              sanitize: true,
              smartLists: true,
              smartypants: false
            });
    </script>
@endsection