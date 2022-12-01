<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function registration(Request $request) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        $request->validate([
            'email' => 'required|email|unique:users|max:320',
            'password' => 'required|max:128',
            'first_name' => 'required|max:128',
            'last_name' => 'required|max:128',
            'patronymic' => 'max:128',
            'birthday' => 'date',
            'phone' => 'required|max:11|unique:users',
        ]);

        User::create($request->all());

        return redirect('books');
    }

    public function login(Request $request): string {
        $account = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(!Auth::attempt($account)){
            return "Логин или пароль не верный!";
        }

        return redirect('books');
    }
}
