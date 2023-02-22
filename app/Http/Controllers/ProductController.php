<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function displayProduct()
    {
        // traukti duomenis is DB arba is API kazkokio
        return view('products', [
            'name' => 'Batai',
            'price' => number_format(12, 2)
        ]);
    }

    public function create()
    {
        $product = new Product(); //susikūrėme naują objektą
        $product->name = 'apple'; //name priskirti įrašą apple
        $product->price = 99.7;
        // $product->created_at('2023-02-01 00:00:01');
        $product->save(); // viską išsaugok

        dd($product);
    }
}
