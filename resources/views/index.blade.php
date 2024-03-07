@extends('layout')
@section('title', 'Car app')
@section('content')

<div class="hero-container"></div>
    <div class="button-container">
        <a href="/login" class="btn-btn-primary">Login</a>
        <a href="/register" class="btn-btn-primary">Register</a>
    </div>
    
@include('errors')
@endsection
