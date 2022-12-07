<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookWarehouse;
use App\Models\File;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class Order extends Controller
{
    public function create(): \Illuminate\Http\RedirectResponse
    {
      $userId = Auth::id();
      $data = Basket::getItemIds($userId);

      $books = Book::query()
        ->whereIn('id', array_keys($data))
        ->with('file')
        ->with('authors')
        ->get();
      $order = new \App\Models\Order();
      $order->sale_date = Date::now();
      $order->user_id = $userId;

      foreach ($books as $book){
        $bookId = $book->id;
        $count = $data[$bookId];

        $book->count = $count;

        $warehouse = Warehouse::query()->firstOrFail();
        $bookOnWarehouse = BookWarehouse::query()
          ->where('warehouse_id', $warehouse->id)
          ->where('book_id', $bookId)
          ->firstOrFail();

        $bookOnWarehouse->count -= $count;

        if ($bookOnWarehouse->count < 0){
          throw new \Exception("Извините, что-то пошло не так");
        }

        $order->save();
        $order->books()->attach([$bookId], ['count' => $count]);
        $bookOnWarehouse->save();
      }


      Basket::clear($userId);

      return redirect('success-order/' . $order->id);
    }

    public function updateStatus(Request $request){
      $order = \App\Models\Order::query()->where('id', $request['order_id'])->firstOrFail();
      $order->status_id = $request['status_id'];
      $order->save();

      return redirect()->back();
    }
}
