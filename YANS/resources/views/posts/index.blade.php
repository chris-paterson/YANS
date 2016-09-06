@extends('layouts.app')

@section('title')
    Index
@endsection

@section('css')
    <link href="/css/card.css" rel="stylesheet">
@endsection

@section('content')
    @foreach($posts as $post)
        @include('layouts.post-index-card', ['post' => $post])
    @endforeach
@endsection

@section('scripts')
    <script src="/js/marked.js"></script>

    <script>
        // $('.card-body').each(function( index ) {
        //     $(this).text = marked($(this).text())
        // });


        // document.getElementByClass('card-body').innerHTML = 
        //     marked(document.getElementByClass('card-body').innerHTML);
    </script>
@endsection