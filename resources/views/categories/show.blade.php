@extends('components.layout')

@section('title', $category->name)

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $category->name }}</h5>
            <p class="card-text">
                <span>Enabled: {{ $category->enabled }}</span>
            </p>
        </div>
    </div>

    <h5>BOOKS:</h5>
    @foreach($category->books as $book)
        <div>
            Name: {{ $book->name }} |
            Puslapiai {{ $book->page_count }}
        </div>
    @endforeach
@endsection
