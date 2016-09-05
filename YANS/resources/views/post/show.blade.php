@extends('layouts.app')

@section('content')
    {{ $post->title }}
    {{ $post->user->name }}
    {{ $post->body }}
@endsection