@extends('layouts.app')

@section('title')
    Index
@endsection

@section('css')
@endsection

@section('content')
    @foreach($posts as $post)
        {{ $post->id }}
    @endforeach
@endsection

@section('scripts')
@endsection