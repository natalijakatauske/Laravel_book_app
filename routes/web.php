<?php

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Public\BookController as PublicBookController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryContoller;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return 'Laravel atėjo čia';
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('book/show/{id}', [PublicBookController::class, 'show']);

// Route::get('/hello/{name}', function ($name) {
//     return 'Bandom ROUTE' . $name;
// });


// Route::get('/products', [ProductController::class, 'displayProduct']);

// Route::redirect('/', 'hello', 301);

// //user/2
// Route::get('user/{id}', function ($id) {
//     return 'User: '. $id;
// });

// // user/2/comments/5
// Route::get('user/{id}/comments/{commentId}', function($id, $commentId) {
//     return 'User: ' . $id . ' - ' . $commentId;
// });

// // product/iPhone
// // product
// Route::get('product/{name?}', function ($name = 'Apple') {
//     return $name;
// });

// // book/2
// Route::get('book/{id}', function ($id) {
//     return $id;
// })->where('id', '[0-9]+'); // priima tik skaičius

// // book/a
// Route::get('book/{id}', function ($id) {
//     return $id;
// })->where('id', '[A-Za-z]+'); // priima tik raides
// // where('id', '[LT-09]+'); priima tik LT12345676

// Route::get('car/{id}/{name}', function($id) {
//     return $id;
// })->whereNumber('id')->whereAlpha('name');

// CRED (Create Read Edit Delete):
// GET index            books/index
// GET show/{id}        books/show/1
// GET create           books/create
// POST store           books/store
// GET edit/{id}        books/edit/1
// PUT update/{id}      books/update/1
// DELETE destroy/{id}  books/destroy/1

Route::get('books', [BookController::class, 'index']); // kviečia index metodą
Route::get('books/books-without-author', [BookController::class, 'indexWithoutAuthors']);
Route::get('books/{id}', [BookController::class, 'show'])->whereNumber('id'); // kviečia show metodą
Route::get('books/create', [BookController::class, 'create']);
Route::post('books/create', [BookController::class, 'store']);
Route::any('books/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
Route::delete('books/delete/{id}', [BookController::class, 'delete'])->name('book.delete');

Route::get('categories', [CategoryContoller::class, 'index'])->middleware(['auth']);
Route::get('categories/create', [CategoryContoller::class, 'create']);
Route::post('categories/create', [CategoryContoller::class, 'store']);
// Route::any('categories/save', [CategoryContoller::class, 'store']); // ARBA:
// Route::post('categories/save', [CategoryContoller::class, 'store']);
// Route::get('categories/json', [CategoryContoller::class, 'json']);
Route::any('categories/edit/{id}', [CategoryContoller::class, 'edit'])->name('category.edit');
Route::delete('categories/delete/{id}', [CategoryContoller::class, 'delete'])->name('category.delete');
Route::get('categories/{id}', [CategoryContoller::class, 'show']);


Route::get('products/create', [ProductController::class, 'create']);

Route::get('authors', [AuthorController::class, 'index']);
Route::get('authors/create', [AuthorController::class, 'create']);
Route::post('authors/create', [AuthorController::class, 'store']);
Route::any('authors/edit/{id}', [AuthorController::class, 'edit'])->name('authors.edit');
Route::delete('authors/delete/{id}', [AuthorController::class, 'delet'])->name('authors.delete');
Route::get('authors/{author}', [AuthorController::class, 'show']);

// ARBA su resource atomatiškai:

// Route::resource('books', BookController::class);

// // Jeigu yra daugiau nei vienas:
// Route::resources([
//     'books' => BookController::class,
//     'users' => UserController::class,
//     'categories' => CategoryContoller::class
// ]);

Route::get('products', [ItemController::class, 'index']);
Route::get('products/{id}', [ItemController::class, 'show']);

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'show'])->name('login'); //renderina login formą
    Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate'); //submitina formą
});

// Route::get('login', [AuthController::class, 'show'])->middleware('guest')->name('login'); //rendirina formą
// Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate'); // submitiną formą

Route::get('logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::get('profile', [UserController::class, 'show'])
    ->middleware(['auth', 'role'])
    ->name('profile');
Route::get('register', [UserController::class, 'register'])->middleware('guest')->name('register');
Route::post('register', [UserController::class, 'store'])->name('create.user');