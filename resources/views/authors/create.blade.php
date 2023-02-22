@extends('components.layout')


@section('content')
<h3>Create new author</h3>

<form action="{{ url('authors/create') }}" method="post">

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
    <input type="text" name="name" placeholder="First name"><br>
    <input type="text" name="last_name" placeholder="Last name"><br>
    <input type="date" name="birth_date" placeholder="Birth date"><br>
    <input type="text" name="country" placeholder="Country"><br>

    <button type="submit">Save</button>
</form>
@endsection
