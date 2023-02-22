@extends('components.layout')

@section('title', 'Authors')

@section('content')
    <h1>Authors</h1>

    @include('components.alert.success_message')

    <div class="row">
        <div class="col">
            <a href="{{ url('authors/create') }}" class="btn btn-primary">Create</a>
        </div>
    </div>

    <table class="table">
        <tr>
            <th scope="col" width="100">ID</th>
            <th scope="col">Name, Surname</th>
            <th scope="col">Birth date</th>
            <th scope="col">Country</th>
            <th scope="col" width="100">Edit</th>
            <th scope="col" width="100">Delete</th>
        </tr>
        @foreach($authors as $author)
            <tr>
                <th scope="row">{{ $author->id }}</th>
                <td>
                    <a href="{{ url('authors', ['id' => $author->id]) }}">{{ $author->name }} {{ $author->last_name }}</a>
                </td>
                <td>{{ $author->birth_date }}</td>
                <td>{{ $author->country }}</td>
                <td>
                    <a href="{{ route('authors.edit', ['id' => $author->id]) }}" class="btn btn-info">Edit</a>
                </td>
                <td>
                    <form action="{{ route('authors.delete', ['id' => $author->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
