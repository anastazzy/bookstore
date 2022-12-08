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

class Vendor extends Controller
{
    public function getProfit(Request $request)
    {
      $profit = 0;
      if ($request->startDate and $request->endDate and $request->endDate > $request->startDate){

        $orders = \App\Models\Order::query()->where('status_id', 3)
          ->where('placing_date', '>=', $request->startDate)
          ->where('placing_date', '<=', $request->endDate)
          ->with('books')
          ->get();

        foreach ($orders as $order){
          foreach($order->books as $book){
            $profit += ($book->sale_price - $book->purchase_price) * $book->pivot->count;
          }
        }
      }
      return \view('lk-vendor')->with('profit', $profit);
    }

  public function getRating(Request $request)
  {
    $dictionary = array();
    if ($request->startDate and $request->endDate and $request->endDate > $request->startDate){

      $orders = \App\Models\Order::query()->where('status_id', 3)
        ->where('placing_date', '>=', $request->startDate)
        ->where('placing_date', '<=', $request->endDate)
        ->with('books')
        ->get();

      foreach ($orders as $order){
        foreach($order->books as $book){
          if (!array_key_exists($book->id, $dictionary)){
            $dictionary[$book->id] = ['profit' => ($book->sale_price - $book->purchase_price) * $book->pivot->count];
          } else{
            $sum = $dictionary[$book->id]['profit'];
            $dictionary[$book->id]['profit'] = $sum + ($book->sale_price - $book->purchase_price) * $book->pivot->count;
          }
        }
      }
    }
    arsort($dictionary);
    return \view('lk-vendor')->with('rating', $dictionary);
  }
}
