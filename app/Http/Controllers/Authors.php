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

class Authors extends Controller
{
    public function create(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|max:128',
            'last_name' => 'required|max:128',
            'patronymic' => 'max:128',
        ]);

        $author = new Author();
        $author->fill($request->all());
        $author->save();

        return \Redirect::back();
    }
}
