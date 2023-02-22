<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ItemController extends Controller
{
    public function index(): View
    {
        $indexArray =
            [
                [
                    'id' => 1,
                    'name' => "Obuolys",
                    'price' => 1.29
                ],
                [
                    'id' => 2,
                    'name' => "Bananas",
                    'price' => 1.79
                ],
            ];
        return view('items/index', ['products' => $indexArray]);
    }

    public function show($name): View
    {
        $showArray =
            [
                'id' => 1,
                'name' => $name,
                'price' => 1.59
            ];
        return view('items/show', $showArray);
    }
}
