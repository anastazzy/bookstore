<?php

use App\Basket;
use App\Http\Controllers\Authors;
use App\Http\Controllers\Books;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Warehouse;
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

Route::get('/orders', function () {
  $orders = \App\Models\Order::query()
    ->with('books')
    ->leftJoin('statuses', 'statuses.id', '=', 'orders.status_id')// только 1 книга из-за этого
    ->get();
  return view('list-orders')
    ->with('orders', $orders);
})->middleware('auth');



Route::get('/success-order/{orderId}', function ($orderId) {
  return view('success-order')->with('orderId', $orderId);
})->middleware('auth');

//корзина
Route::get('/basket', function () {
  $inputData = Basket::getItemIds(Auth::id());

  $books = Book::query()
    ->whereIn('id', array_keys($inputData))
    ->with('file')
    ->with('authors')
    ->with('warehouses:id')
    ->get();
  foreach ($books as $book){
    $allCount = 0;
    $count = $inputData[$book->id];
    $book->count = $count;
    foreach ($book->warehouses as $warehouse){
      $allCount += $warehouse->pivot->count;
    }
    $book->warehousesCount = $allCount;
  }
  return view('basket')->with('books', $books);
})->middleware('auth');

Route::post('/basket', [\App\Http\Controllers\Order::class, 'create'])
    ->middleware('auth');

Route::post('/basket/clear', function (){
  Basket::clear(Auth::id());
  return redirect()->back();})
  ->middleware('auth');

Route::post('/basket/delete/{id}',function ($bookId){
  Basket::deleteItemId(Auth::id(), $bookId);
  return redirect()->back();
})->middleware('auth');

Route::post('/basket/update-count/{id}',function ($bookId, \Illuminate\Http\Request $request){
    Basket::updateItemCount(Auth::id() ,$bookId, $request['count']);
    return redirect()->back();
})->middleware('auth');

//получение конкретной книги по идентификатору
Route::get('/book/{id}', function ($bookId){
  $data = Book::query()
    ->where('id', $bookId)
    ->with('file')
    ->with('authors')
    ->with('genres')
    ->with('warehouses:id')
    ->firstOrFail();
  $allCount = 0;
  foreach ($data->warehouses as $warehouse){
    $allCount += $warehouse->pivot->count;
  }
  $data->warehousesCount = $allCount;
  $data->basket_count = Basket::getItemCount(Auth::id(), $data->id);
  return view('detailed-book')->with('book', $data);
})->middleware('auth');

Route::get('book-service/update-book/{id}', function ($bookId){
  $data = Book::query()
    ->where('id', $bookId)
    ->with('file')
    ->with('authors')
    ->with('genres')
    ->with('warehouses')
    ->firstOrFail();
  $allCount = 0;
  foreach ($data->warehouses as $warehouse){
    $allCount += $warehouse->pivot->count;
  }
  $data->warehousesCount = $allCount;

  return view('update-book')
    ->with('book', $data)
    ->with('authors', Author::query()->get())
    ->with('warehouses', Warehouse::query()->get())
    ->with('genres', Genre::query()->get());
})->middleware('auth');

Route::post('book-service/update-book/{id}', [Books::class, 'update'])
  ->middleware('auth');

//обновить количество товара в корзине
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
  $data = Book::with('file')
    ->with('authors')
    ->with('warehouses:id')
    ->get();
  foreach ($data as $book) {
    $book->basket_count = Basket::getItemCount(Auth::id(), $book->id);
    $allCount = 0;
    foreach ($book->warehouses as $warehouse){
      $allCount += $warehouse->pivot->count;
    }
    $book->warehousesCount = $allCount;
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


