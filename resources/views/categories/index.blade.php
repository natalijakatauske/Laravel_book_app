@extends('components.layout')

@section('title', 'Categories')

@section('content')

    <h1>Categories</h1>

    @include('components.alert.success_message')

    <div class="row">
        <div class="col">
            <a href="{{ url('categories/create') }}" class="btn btn-primary">Create</a>
        </div>
    </div>

    <table class="table">
        <tr>
            <th scope="col" width="100">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Parent</th>
            <th scope="col">Is Enabled</th>
            <th scope="col" width="100">Edit</th>
            <th scope="col" width="100">Delete</th>
        </tr>
        @foreach($categories as $category)
        <tr>
            <th scope="row">{{ $category->id }}</th>
            <td>
                <a href="{{ url('categories', ['id' => $category->id]) }}">{{ $category->name }}</a>
            </td>
            <td>
                @if($category->parentCategory)
                    {{ $category->parentCategory->name }}
                @endif
            </td>
            <td>{{ $category->enabled }}</td>
            <td>
                <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-info">Edit</a>
            </td>
            <td>
                <form action="{{ route('category.delete', ['id' => $category->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </table>
@endsection