<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

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
