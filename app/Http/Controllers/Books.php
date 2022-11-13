<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
        $path = Storage::disk('local')->putFile('images', $file);
        $request->validate([
            'article_number' => 'required|int|unique:books',
            'name' => 'required|max:512',
            'author_id' => 'required|int',
            'description' => 'required|max:2048',
            'purchase_price' => 'required',
            'sale_price' => 'required',
        ]);

        $fileInDb = File::query()->create(['path' => $path]);
        $book = $request->all();
        $book['file_id'] = $fileInDb->id;
        Book::query()->create($book);

        return redirect('main');
    }
//
//    public function login(Request $request): string {
//        $account = $request->validate([
//            'email' => ['required', 'email'],
//            'password' => ['required'],
//        ]);
//
//        if(!Auth::attempt($account)){
//            return "Логин или пароль не верный!";
//        }
//
//        return redirect('main');
//    }
}
