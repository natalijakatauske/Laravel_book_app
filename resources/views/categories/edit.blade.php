@extends('components.layout')

@section('title', 'Edit' . $category->name)

@section('content')

<h3>Category {{ $category->name }} edit form</h3>

<form action="{{ route('category.edit', ['id' => $category->id]) }}" method="post" class="row g-3">
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
        <label class="form-label">Category name:</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder="Category name">
        @error('name')
        <div class="invalid-feedback">{{ $$message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Parent category</label>
        <select name="category_id" class="form-control">
            <option value="">--</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @if($cat->id === $category->category_id) selected @endif>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <input type="checkbox" name="enabled" class="form-check-input" value="1" @if ($category->enabled) checked @endif>
        <label class="form-check-label">Enabled?</label>
    </div>
    
    <div class="col-12">
        <button type="submit" class="btn btn-info">Save</button>
    </div>
</form>
@endsection