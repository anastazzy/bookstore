<?php

use App\Basket;
use App\Http\Controllers\Authors;
use App\Http\Controllers\Books;
use App\Models\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;

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
//получение конкретной книги по идентификатору
Route::get('/book/{id}', function ($bookId){
    $data = Book::query()
        ->where('id', $bookId)
        ->with('file')
        ->with('authors')
        ->firstOrFail();
    $data->basket_count = Basket::getItemCount(Auth::id(), $data->id);
    return view('detailed-book')->with('book', $data);
})->middleware('auth');

//обвновление корзины
Route::post('/book/{id}', function ($bookId, \Illuminate\Http\Request $request){
    Basket::updateItemCount(Auth::id() ,$bookId, $request['count']);
    return redirect($request->url());
})->middleware('auth');

//создание книги
Route::post('/book', [Books::class, 'create'])
    ->middleware('auth');

//создание автора
Route::post('/author', [Authors::class, 'create'])
    ->middleware('auth');

//получение списка книг
Route::get('/book-service', function () {
    return view('bookService')->with('books', Book::all());
})->middleware('auth');

Route::get('/books', function () {
    $data = Book::with('file')->with('authors')->get();
    foreach ($data as $book) {
        $book->basket_count = Basket::getItemCount(Auth::id(), $book->id);
    }
    return view('books')->with('books', $data);
})->middleware('auth');

Route::post('/books', function (\Illuminate\Http\Request $request){
    $bookId = $request->all();
    Basket::updateItemCount(Auth::id() ,$bookId['bookId'], $request['count']);
    return redirect($request->url());
})->middleware('auth');


//регистрация
Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [Login::class, 'registration']);

//вход в систему
Route::post('/login', [Login::class, 'login']);

Route::get('/login', function () {
    return view('login');
});

//Index
Route::get('/', function () {
    return view('index');
});


