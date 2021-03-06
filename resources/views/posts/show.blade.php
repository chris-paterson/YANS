@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('css')
    <link href="/css/post.css" rel="stylesheet">
@endsection

@section('content')
    @if(Session::has('danger'))
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get('danger') }}
        </div>
    @endif

    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get('success') }}
        </div>
    @endif


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
        @endif

        @if(!Auth::user() && !$post->shouldDisplayFull())
            <div id="article-body">{{ $post->preview }}</div>

            <a class="btn btn-default btn-block btn-lg" role="button" href="{{ url('/login') }}">
                You must log in to purchase this post
            </a>
        @elseif($post->shouldDisplayFull())
            <div id="article-body">{{ $post->body }}</div>
        @else
            {{-- User is logged in but has not bought  --}}
            <div id="article-body">{{ $post->preview }}</div>

            <a class="btn btn-default btn-block btn-lg" id="purchase-button" role="button" data-toggle="modal" data-target=".preview-modal">
                Purchase the rest of this post for ${{ $post->price }}
            </a>
        @endif
    </div>
    @include('modals.payment-modal')
@endsection

@section('scripts')
    <script src="/js/marked.js"></script>
    <script>
        document.getElementById('article-body').innerHTML = 
            marked(document.getElementById('article-body').innerHTML);
    </script>
@endsection