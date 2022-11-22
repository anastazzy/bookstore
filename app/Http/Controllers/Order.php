<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\File;
use App\Models\User;
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

        foreach (array_keys($data) as $bookId){
            $count = $data[$bookId];

            $book = Book::query()
                ->where('id', $bookId)
                ->with('file')
                ->with('authors')
                ->firstOrFail();
            $book->count = $count;

            $order = new \App\Models\Order();

            $order->sale_date = Date::now();
            $order->user_id = $userId;
            $order->save();
            $order->books()->sync(['id' => $bookId]);
        }

        return \Redirect::back();
    }
}
