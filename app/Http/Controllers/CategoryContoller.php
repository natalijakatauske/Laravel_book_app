<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class CategoryContoller extends Controller
{
    public function index(): View
    {
        // select * from categories where enabled = 1 limit 1 (išveda vieną reikšmę)
        // $categories = Category::all()->where('enabled', '=', 1)->take(1);

        $categories = Category::all();
        // $categories = Category::withTrashed()->get(); grąžina su ištrintomis kategorijomis
        // $categories = Category::onlyTrashed()->get(); grąžina tik ištrintas kategorijas

        return view('categories/index', [
            'categories' => $categories
        ]);
    }

    public function show(int $id): View
    {
        $category = Category::find($id);
        // dd($category->books);

        if ($category === null) {
            abort(404);
        }
        return view('categories/show', [
            'category' => $category
        ]);



        // echo 'Category Controller method: show ID: ' . $id;

        // return view('categories/show');
        // throw new \Exception('Could not found');
    

        // if ($id == 1) {
        //     return response()->view('categories/show', [], 200); // status 200 yra default(is OK)
        // }
        // return response()->view('categories/error', [], 500); // status 500 is error

        // $categories = Category::find($id);
        // return response()->view('categories/show', ['categories' => $categories]);
    }

    // public function store(Request $request): View
    // {
        // if ($request->isMethod('post')) {
        //     $name = $request->post('full_name');

        //     return view('categories/store', [
        //         'name' => $name
        //     ]);
        // }
        

        // return view('categories/store');
    // }

    public function store(StoreCategoryRequest $request)
    {
        // if ($request->isMethod('post')) {
            // $category = new Category();
            // $category->name = $request->post('category_name');
            // if ($request->post('enabled')) {
            // $category->enabled = $request->post('enabled', 0);
            // }
            // $category->save();
    
                // validacija
                // $request->validate([
                //     'name' => 'required|max:12'
                // ]);
                $request->validated([]);
    
                Category::create($request->all());
    
                return redirect('categories')
                ->with('success', 'Category created successfully!');
        // }
    }

    public function create(): View|RedirectResponse
    {
        // SELECT * from categories where category_id is null:
        $categories = Category::where('category_id', null)->get();

        return view('categories/create', [
            'categories' => $categories
        ]);
    }

    public function edit(int $id, Request $request)
    {
        // CRUD
        // C - create
        // R - read
        // U - update
        // D - delete

        // 1. Reikėtų atvaizduoti viską formoje, t.y. turimą informaciją
        // 1.1. Reiktų gauti attitinkamą kategoriją

        $category = Category::find($id); // Select * from categories Where id = {$is} -> new Category()

        // 1.2. Pasitikrinti ar ta kategorija egzistuoja

        if ($category === null) {
            abort(404);
        }

        // 2. Update'inam 
        // 2.1. tikriname ar post methodas 
        if ($request->isMethod('post')) {
            // validation:
            $request->validate(
                ['name' => 'required|min:3|max:20'
            ]);
            // 2.2. užsetiname category properties
            // $category->name = $request->post('name');
            // $category->enabled = $request->post('enabled', false);
            // // 2.3. pasaugom į duomenų bazę
            // $category->save();
            // 2.4. Nukreipiame į index action

            // ARBA vietoje visko šito paprasčiau su viena eilute:
            // $category->update($request->all());

            $category->fill($request->all());
            $category->enabled = $request->post('enables', false);
            $category->save();

            return redirect('categories')->with('success', 'Category updated!');
        }

        // 1.3. Pagrąžinti kategoriją ė tempalte
        // 1.4. Išvesti kategorijos duomenis template
        // 1.5. Pakurti atitinkamą route
        // 1.6. Nuoroda sąraše, kuri nuves į edit formą

        // dd($category);
        $categories = Category::where('category_id', null)->get();
        return view('categories/edit', [
            'category' => $category,
            'categories' => $categories,
        ]);

        
    }

    public function delete(int $id)
    {
        // 1. Gauname pagal id kokią kategoriją išvalyti
        $category = Category::find($id);

        // 2. Patikriname ar tokia egzistuoja
        if ($category === null) {
        // 3. Jeigu neegzistuoja metam 404
            abort(404);
        }
        // 4. Jeigu egzistuoja - išvalom
        $category->delete();
        
        // 5. Po sėkmingo išvalymo redirektiname su sekmės pranešimu
        return redirect('categories')->with('success', 'Category was removed!');
    }

    // public function json(): JsonResponse
    // {
    //     return response()->json(
    //         [
    //         'product_name' => 'TV',
    //         'price' => 333
    //         ]
    //     );
    // }
}
