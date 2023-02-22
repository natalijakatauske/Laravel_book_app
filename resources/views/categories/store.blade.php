<h3>Fill name:</h3>
<form action="{{ url('categories/save') }}" method="POST">
    @csrf
    <input type="text" name="full_name">
    <button type="submit">Send</button>
</form>

@if (isset($name))
<div>
    My name: {{ $name }}
</div>
@endif