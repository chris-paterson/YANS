@extends('layouts.app')

@section('title')
Forbidden
@endsection

@section('css')
    <link rel="stylesheet" href="/css/error.css">
@endsection

@section('content')
<div class="error-container">
    <div class="error-content">
        <div class="error-title">Forbidden</div>
        <img src="http://i.imgur.com/kgfV66r.gif" alt="Ah Ah Ahhhhhh">
    </div>
</div>
@endsection