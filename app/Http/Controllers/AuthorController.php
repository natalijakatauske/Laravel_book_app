<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

        return view('authors/index', [
            'authors' => $authors
        ]);
    }

    // public function show(int $id): View
    // {
    //     $author = Author::find($id);

    //     if ($author === null) {
    //         abort(404);
    //     }
    //     return view('authors/show', [
    //         'author' => $author
    //     ]);
    // }

    public function show(Author $author): View
    {
        return view('authors/show', compact('author'));
    }

    //atsakinga uz saugojima create formos
    public function store(Request $request) {

        $request->validate(
            [
                'name' => 'required|max:20',
                'last_name' => 'required|max:20',
                'country' => 'required|max:20',
                'birth_date' => 'required|date',
            ]
        );

        Author::create($request->all());

        //TODO change to authors list
        return redirect('authors')
            ->with('success', 'Author created successfully!');
    }

    //atsakinga uz atvaizdavima create formos
    public function create(): View
    {
        return view('authors/create');
    }

    public function edit(Request $request, int $id): View|RedirectResponse
    {
        $author = Author::find($id);

        if ($author === null) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $request->validate(
                [
                    'name' => 'required|max:20',
                    'last_name' => 'required|max:20',
                    'country' => 'required|max:20',
                    'date_of_birth' => 'required|date',
                ]
            );

            $author->fill($request->all());
            $author->save();

            return redirect('authors')->with('success', 'Category updated!');
        }
    }
    
    public function delete(int $id)
    {
        /*
         * CRUD
         * C - create
         * R - read
         * U - update
         * D - delete *
         */

        //1. Gaunam pagal id kokia kategorija isvalyt
        $author = Author::find($id);

        //2. Patikrinam ar tokia egzistuoja
        if ($author === null) {
            //3. jeigu neegzistuoja metam 404
            abort(404);
        }

        //4. jeigu egzistuoja isvalom
        $author->delete();

        //5. Po sėkmingo išvalymo redirectinam su sėkmės pranešimu.
        return redirect('authors')->with('success', 'Author was removed!');
    }
}


