@extends('components.layout')

@section('title', 'Books')

@section('content')

    <h1>Books</h1>

    @include('components.alert.success_message')

    <div class="row">
        <div class="col">
            <form action="{{ url('books') }}" method="get">

            <div class="col-12">
                <label class="form-label">Book name:</label>
                <input type="text" name="name"  value="{{ $name }}" class="form-control" placeholder="Book name">
            </div>
    
                <div class="col-12">
                    <label class="form-label">Category:</label>
                    <select name="category_id" class="form-control">
                        <option></option>
                        @foreach($categories as $category)
                            <option @if($category->id == $category_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                            @foreach($category->childrenCategories as $childrenCategory)
                                <option @if($childrenCategory->id == $category_id) selected @endif value="{{ $childrenCategory->id }}">--- {{ $childrenCategory->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-info">Filter</button>
                    <a href="{{ url('books') }}" >clear</a>
                </div>

            </form>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <a href="{{ url('books/create') }}" class="btn btn-primary">Create</a>
        </div>
    </div>

    {{-- komentaras --}}

    <table class="table">
        <tr>
            <th scope="col" width="100">ID</th>
            <th scope="col">Name</th>
            <th>Image</th>
            <th scope="col">Author</th>
            <th scope="col">Category</th>
            <th scope="col">Page count</th>
            <th scope="col" width="100">Edit</th>
            <th scope="col" width="100">Delete</th>
        </tr>
        @foreach($books as $book)
        <tr>
            <th scope="row">{{ $book->id }}</th>
            <td>
                <a href="{{ url('books', ['id' => $book->id]) }}">{{ $book->name }}</a>
            </td>
            <td>
            @if ($book->image)
                <img src="{{ asset($book->image) }}">
            @else
                No image
            @endif
            </td>
            <td>
                @if($book->authors)
                    @foreach($book->authors as $author)
                    {{ $author->full_name }},
                    @endforeach
                @endif
            </td>
            <td>
                @if($book->category)
                    {{ $book->category->name }}
                @endif
            </td>
            <td>
                <a href="{{ url('books', ['id' => $book->id]) }}">{{ $book->page_count }}</a>
            </td>
            <td>
                <a href="{{ route('book.edit', ['id' => $book->id]) }}" class="btn btn-info">Edit</a>
            </td>
            <td>
                <form action="{{ route('book.delete', ['id' => $book->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </table>
    <div class="row">
        <div class="col">
            {{ $books->links() }}
        </div>
    </div>
@endsection