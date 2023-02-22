@extends('components.layout')

@section('title', 'Edit' . $author->name . $author->last_name)

@section('content')

<h3>Author {{ $author->name }} edit form</h3>

<form action="{{ route('authors.edit', ['id' => $author->id]) }}" method="post" class="row g-3">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @csrf
    <div class="col-12">
        <label class="form-label">Author name:</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Category name">
        @error('name')
        <div class="invalid-feedback">{{ $$message }}</div>
        @enderror
    </div>

    
    
    <div class="col-12">
        <button type="submit" class="btn btn-info">Save</button>
    </div>
</form>
@endsection