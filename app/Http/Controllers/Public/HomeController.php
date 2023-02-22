<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Book;

class HomeController extends Controller
{
    public function index(): View
    {
        $books = Book::all();

        // return view('public/home', [
        //     'books' => $books,
        // ]);
        // ARBA:

        return view('public/home', compact('books'));
    }
}
