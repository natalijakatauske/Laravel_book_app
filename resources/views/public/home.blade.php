@extends('components.min_layout')

@section('content')
    <div class="row">
    @foreach($books as $book)
        <div class="col-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->name }}</h5>
                    <h6 class="card-subtitle text-muted">
                        @if($book->category)
                            {{ $book->category->name }}
                        @endif
                    </h6>
                    <a href="{{ url('book/show', ['id' => $book->id]) }}">Link</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endsection