<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class Consumer extends Controller
{
    public function getSum(Request $request)
    {
      $profit = 0;
      if ($request->startDate and $request->endDate and $request->endDate > $request->startDate){

        $orders = \App\Models\Order::query()->where('status_id', 3)
          ->where('placing_date', '>=', $request->startDate)
          ->where('placing_date', '<=', $request->endDate)
          ->where('user_id', Auth::id())
          ->with('books')
          ->get();

        if ($orders->isNotEmpty()){
          foreach ($orders as $order){
            foreach($order->books as $book){
              $profit += $book->sale_price * $book->pivot->count;
            }
          }
        }
      }
      return \view('list-order-consumer ')->with('profit', $profit);
    }
}
