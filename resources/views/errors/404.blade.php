@extends('layouts.app')

@section('title')
404
@endsection

@section('css')
    <link rel="stylesheet" href="/css/error.css">
@endsection

@section('content')
<div class="error-container">
    <div class="error-content">
        <div class="error-title">404 Not Found</div>
        <div class="error-subtitle">(insert witty image)</div>
        <a class="btn btn-default btn-lg btn-block" role="button" href="{{ URL::previous() }}">
            Back
        </a>
    </div>
</div>
@endsection