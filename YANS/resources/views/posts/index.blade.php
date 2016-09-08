@extends('layouts.app')

@section('title')
    Index
@endsection

@section('css')
    <link rel="stylesheet" href="/css/post.css">
    <link rel="stylesheet" href="/css/card.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
            <a class="btn btn-default btn-lg btn-block" role="button" href="{{ route('posts.create') }}">
                Write a new article
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
            @foreach($posts as $post)
                @include('layouts.post-index-card', ['post' => $post])
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/marked.js"></script>

    <script>
        let $cards = $('.card-body')

        $cards.each(function() {
            this.innerHTML = marked(this.textContent).substring(0, 1024)
        })
    </script>
@endsection