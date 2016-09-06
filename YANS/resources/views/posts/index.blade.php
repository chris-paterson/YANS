@extends('layouts.app')

@section('title')
    Index
@endsection

@section('css')
    <link rel="stylesheet" href="/css/post.css">
    <link rel="stylesheet" href="/css/card.css">
@endsection

@section('content')
    @foreach($posts as $post)
        @include('layouts.post-index-card', ['post' => $post])
    @endforeach
@endsection

@section('scripts')
    <script src="/js/marked.js"></script>

    <script>
        let $cards = $('.card-body')

        $cards.each(function() {
            this.innerHTML = marked(this.textContent)
        })
    </script>
@endsection