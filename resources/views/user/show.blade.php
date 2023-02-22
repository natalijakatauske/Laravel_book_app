@extends('components.layout')
@section('title', 'User profile')
@section('content')
    <div class="card">
        <div>Name: {{ $user->name }}</div>
        <div>Email: {{ $user->email }}</div>
    </div>
@endsection