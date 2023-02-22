<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;



class BookController extends Controller
{
    public function index(Request $request): View
    {
        // 1. Gauti filtrus iš request
        // 2. Pasitirinti ar tam tikras key yra request
        // 3. Jeigu yra tuomet turime prideti where filtrą

        # 1. abudu
        # 2. tik category
        # 3. tik book name

        $books = Book::query(); //query builser

        if ($request->query('category_id')) {
            $books->where('category_id', '=', $request->query('category_id'));
        }

        if ($request->query('name')) {
            $books->where('name', 'like', '%' . $request->query('name') . '%');
        }

        $books = $books->paginate(10);
        
        // $books = Book::with('category', 'authors')->paginate(10);
        // $books = Book::without('authors')->paginate(10);
        

        $categories = Category::where('enabled', '=', 1)
            ->where('category_id', null)
            ->with('childrenCategories')
            ->get();

        return view('books/index', [
            'books' => $books,
            'categories' => $categories,
            'category_id' => $request->query('category_id'),
            'name' => $request->query('name')
        ]);

        // foreach ($books as $book) {
        //     var_dump($book->id);
        //     var_dump($book->name);
        // }
        // // $page = $_GET['page'];
        // //Request naudojame todėl, kad legviau redaguoti, paprastesnis kodas:
        // $page = $request->get('page'); 
        // $name = 'Paula';
        // $array = [
        //     [
        //         'product_name' => 'TV',
        //         'price' => 300,
        //     ],
        //     [
        //         'product_name' => 'Phone',
        //         'price' => 500,
        //     ],
        // ];
        // // $request->url(); // galiu pernaudoti visiems dalykams
        // // echo 'Index ' . $page; // užkomitinti, nes sukurtas index.blade.php
        // return view('books/index', [
        //     'page' => $page,
        //     'name' => $name,
        //     'products' => $array,
        //     'books' => $books,
        // ]);
    }

    public function indexWithoutAuthors(): View
    {
        $books = Book::without('authors')->get();

        return view('books/index_without_author', [
            'books' => $books
        ]);
    }

    public function show($id)
    {
        $book = Book::find($id);

        if ($book === null) {
            abort(404);
        }
        
        return view('books/show', [
            'book' => $book
        ]);
    }

    public function create(): View|RedirectResponse
    {
        $authors = Author::all();
        $categories = Category::where('enabled', '=', 1)
            ->where('category_id', null)
            ->with('childrenCategories')
            ->get();

        return view('books/create', [
            'authors' => $authors,
            'categories' => $categories,
        ]);

    }

    // public function store(StoreCategoryRequest $request)
    public function store(Request $request): RedirectResponse
    {
        // 1. Reikia papildyti formą mygtuku <input type=file
        // 2. Pakeisti firmos tipą
        // 3. Pasižiūrėti request'ą
        // 4. Patalpinti failą
        // 5. Prie knygos prisidėti lauką skirtą failo path'ui: migracija
        // 6. Galėsime pasaugoti book image value prie duomenų bazės
        // 7. Pabandysim nuotrauką atvaizduoti template, tam reikės naudoti symlink ir reikės assetus

        $request->validate([
            'name' => 'required|max:50',
            'author_id' => 'required',
            'category_id' => 'required',
            'image' => [
                'required',
                File::types(['jpg', 'wav'])
                    ->min(1024)
                    ->max(12 * 1024),
                ]
        ]);
    
                $book = Book::create($request->all());

                $file = $request->file('image'); // Objektas
                $path = $file->store('book_images'); // Saugom į katalogą
                Storage::disk('public')->put('katalogas', $file); // public kataloge saugom        
                $book->image = $path; // Prisikirimas 
                $book->save();

                $authors = Author::find($request->post('author_id'));
                $book->authors()->attach($authors);
                // ARBA (jeigu su autoriais daugiau nieko daryt nereikia):
                // $book->authors()->attach($request->post('author_id'));
    
                return redirect('books')
                ->with('success', 'Book created successfully!');
    }

    public function edit(Request $request, int $id): View|RedirectResponse
    {
        $book = Book::find($id);

        $authors = Author::all();
        $categories = Category::where('enabled', '=', 1)
            ->whereNull('category_id')
            ->with('childrenCategories')->get();

        if ($book === null) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $request->validate(
                [
                    'name' => 'required|min:3|max:50',
                    'author_id' => 'required',
                    'category_id' => 'required'
                ]
            );

            $book->update($request->all());

            $book->authors()->detach();
            $authors = Author::find($request->post('author_id'));
            $book->authors()->attach($authors);

            return redirect('books')->with('success', 'Book updated!');
        }

        return view('books/edit', [
            'book' => $book,
            'authors' => $authors,
            'categories' => $categories
        ]);

        //return view('books/edit', compact('book', 'authors', 'categories'));
    }
}
