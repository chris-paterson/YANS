@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    {{ App\User::first()->posts }}
@endsection
