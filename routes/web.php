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
//корзина
Route::get('/basket', function () {
    $inputData = Basket::getItemIds(Auth::id());
    $outputData = new \Illuminate\Support\Collection();
    foreach (array_keys($inputData) as $bookId){
        $count = $inputData[$bookId];

        $book = Book::query()
            ->where('id', $bookId)
            ->with('file')
            ->with('authors')
            ->firstOrFail();
        $book->count = $count;

        $outputData->add($book);
    }
    return view('basket')->with('books', $outputData);
})->middleware('auth');

Route::post('/basket', [\App\Http\Controllers\Order::class, 'create'])
    ->middleware('auth');

//получение конкретной книги по идентификатору
Route::get('/book/{id}', function ($bookId){
    $data = Book::query()
        ->where('id', $bookId)
        ->with('file')
        ->with('authors')
        ->with('genres')
        ->firstOrFail();
    $data->basket_count = Basket::getItemCount(Auth::id(), $data->id);
    return view('detailed-book')->with('book', $data);
})->middleware('auth');

Route::get('/update-book/{id}', function ($bookId){
    $data = Book::query()
        ->where('id', $bookId)
        ->with('file')
        ->with('authors')
        ->with('genres')
        ->with('warehouses')
        ->firstOrFail();
    $data->basket_count = Basket::getItemCount(Auth::id(), $data->id);
    return view('detailed-book-for-service')->with('book', $data);
})->middleware('auth');

//обновление корзины
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
   $data = Book::with('warehouses')->with('genres')->get();
    return view('bookService')->with('books', $data);
})->middleware('auth');

Route::post('/book-service', [Books::class, 'delete'])
    ->middleware('auth');

Route::post('/book-service/update-book', [Books::class, 'update'])
    ->middleware('auth');

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


