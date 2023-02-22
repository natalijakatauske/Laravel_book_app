@extends('components.layout')

@section('title', 'Create book')

@section('content')

<h3>Create new book</h3>

@if ($message = Session::get('success'))
    <div>{{ $message }}</div>
@endif

<form action="{{ url('books/create') }}" method="post" class="row g-3" enctype="multipart/form-data">
 
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
        <label class="form-label">Book name:</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Book name">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Author:</label>
        <select name="author_id[]" class="form-control" multiple>
            @foreach($authors as $author)
            <option value="{{ $author->id }}">{{ $author->full_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Category:</label>
        <select name="category_id" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @foreach($category->childrenCategories as $childrenCategory)
                    <option value="{{ $childrenCategory->id }}">--- {{ $childrenCategory->name }}</option>
                @endforeach
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Page count:</label>
        <input type="text" name="page_count" value="{{ old('page_count') }}" class="form-control @error('page_count') is-invalid @enderror" placeholder="Book page count">
        @error('page_count')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Files:</label>
        <input type="file" name="image" class="form-control">
    </div>
 
    
    <div class="col-12">
        <button type="submit" class="btn btn-info">Save</button>
    </div>
</form>
@endsection
