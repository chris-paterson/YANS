@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="jumbotron">
      <h1>Yet Another News Site</h1>
      <p>Write</p>
      <p>Read</p>
      <p>Sell</p>
      <p><a class="btn btn-primary btn-lg" href="{{ url('posts/create') }}" role="button">Write your article now</a></p>
    </div>
@endsection
