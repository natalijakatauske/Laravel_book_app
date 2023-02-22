<h1>ItemController</h1>

<div>
    @foreach($products as $product)
        Prekės ID: {{ $product['id']}}<br>
        Prekes pavadinimas: {{ $product['name'] }}<br>
        Kaina: {{ $product['price'] }}<br>
    @endforeach
</div>
