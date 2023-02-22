@extends('components.layout')

@section('title', $author->name)

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $author->name }} {{ $author->last_name }}</h5>
            <p class="card-text">
                <span>Birth date: {{ $author->birth_date }}</span>
            </p>
        </div>
    </div>
@endsection