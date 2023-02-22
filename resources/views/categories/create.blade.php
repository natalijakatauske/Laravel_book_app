@extends('components.layout')

@section('title', 'Create category')

@section('content')

<h3>Create new catregory</h3>

@if ($message = Session::get('success'))
    <div>{{ $message }}</div>
@endif

<form action="{{ url('categories/create') }}" method="post" class="row g-3">
 
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
        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Category name">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Parent category</label>
        <select name="category_id" class="form-control">
            <option value="">--</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
 
    <div class="col-12">
        <input type="checkbox" name="enabled" class="form-check-input" value="1" @if (old('enabled')) checked @endif>
        <label class="form-check-label">Enabled?</label>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-info">Save</button>
    </div>
</form>
@endsection

