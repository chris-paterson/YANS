@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="jumbotron">
        <h1>Yet Another News Site</h1>
        <h3>Write</h3>
        <h3>Read</h3>
        <h3>Sell</h3>
        <p><a class="btn btn-primary btn-lg" href="{{ route('posts.create') }}" role="button">Write your article now</a></p>

        <p>or</p>

        <p>
            <a class="btn btn-default btn-lg" href="{{ route('posts.index') }}" role="button">Read articles now</a>
        </p>
    </div>
@endsection
