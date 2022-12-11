<?php

use App\Basket;
use App\Http\Controllers\Authors;
use App\Http\Controllers\Books;
use App\Http\Controllers\Order;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Status;
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

Route::get('/orders/my', function (\Illuminate\Http\Request  $request) {
  $query = \App\Models\Order::query()
    ->where('user_id', Auth::id())
    ->with('books')
    ->with('status');

  if ($request['status']){
    $query = $query
      ->where('status_id', $request['status']);
  }
  $orders = $query->get();
  return view('list-order-consumer')
    ->with('orders', $orders)
    ->with('currentStatus', $request['status'])
    ->with('user', Auth::user())
    ->with('profit')
    ->with('statuses', Status::query()->get()->prepend(new Status(['id' => 0, 'name' => 'Статус'])));
})->middleware('auth');

// получение списка заказов
Route::get('/orders', function (\Illuminate\Http\Request  $request) {
  $query = \App\Models\Order::query()
    ->with('books')
    ->with('status')
    ->with('user');

  if ($request['status']){
    $query = $query
      ->where('status_id', $request['status']);
  }

  if ($request['id']){
    $query = $query
      ->where('id', $request['id']);
  }

  $orders = $query->get();

  return view('list-orders')
    ->with('orders', $orders)
    ->with('currentStatus', $request['status'])
    ->with('statuses', Status::query()->get()->prepend(new Status(['id' => 0, 'name' => 'Статус'])));
})->middleware('auth');

Route::post('/orders/edit-status', [Order::class, 'updateStatus'])
->middleware('auth');

//
Route::get('/lk-vendor', function () {
  return view('lk-vendor');
})->middleware('auth');

Route::post('/profit', [\App\Http\Controllers\Vendor::class, 'getProfit'])
  ->middleware('auth');

Route::post('/rating', [\App\Http\Controllers\Vendor::class, 'getRating'])
  ->middleware('auth');

Route::post('/sum-by-period', [\App\Http\Controllers\Consumer::class, 'getSum'])
  ->middleware('auth');
// отображение при успешном заказе
Route::get('/success-order/{orderId}', function ($orderId) {
  return view('success-order')->with('orderId', $orderId);
})->middleware('auth');

// получить корзину с книгами
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

// оформление заказа
Route::post('/basket', [\App\Http\Controllers\Order::class, 'create'])
    ->middleware('auth');

// очистка корзины
Route::post('/basket/clear', function (){
  Basket::clear(Auth::id());
  return redirect()->back();})
  ->middleware('auth');

// удаление конкретного товара из корзины
Route::post('/basket/delete/{id}',function ($bookId){
  Basket::deleteItemId(Auth::id(), $bookId);
  return redirect()->back();
})->middleware('auth');

// обновление количества конкретного товара
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

//
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
Route::get('/book-service', function (\Illuminate\Http\Request  $request) {
  $query = Book::with('warehouses')->with('authors')->with('genres');

  if ($request['search']){
    $search = $request['search'];
    $query = $query->where(function ($query) use ($search){
      return $query->where('name', 'like', "%$search")
        ->orwhere('name', 'like', "$search%")
        ->orwhere('name', 'like', "%$search%")
        ->orwhere('description', 'like', "%$search%")
        ->orwhere('description', 'like', "$search%")
        ->orwhere('description', 'like', "%$search")
        ->orwhere('description', 'like', "$search");
    });
  }

  $data = $query->get();
    return view('bookService')->with('books', $data);
})->middleware('auth');

Route::post('/book-service', [Books::class, 'delete'])
    ->middleware('auth');

Route::post('/book-service/update-book', [Books::class, 'update'])
    ->middleware('auth');

//получить каталог для авторизованного пользователя
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
Route::get('/logout', [Login::class, 'logout']);

//Index
Route::get('/', function () {
    return view('index');
});


