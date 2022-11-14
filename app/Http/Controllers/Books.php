<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class Books extends Controller
{
    public function create(Request $request) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        $file = $request->photo;
        $path = Storage::disk('public')->putFile('images', $file);
        $request->validate([
            'article_number' => 'required|int|unique:books',
            'name' => 'required|max:512',
            'author_id' => 'required|int',
            'description' => 'required|max:2048',
            'purchase_price' => 'required',
            'sale_price' => 'required',
        ]);

        $file = new File(['path' => $path]);
        $file->save();

        $book = new Book();
        $book->fill($request->all());
        $book->file_id = $file->id;
        $book->save();

        $book->authors()->sync([$request->author_id]);

        return \Redirect::back();
    }
}
