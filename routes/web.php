<?php

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

Route::get('/main', function () {
    return view('main', ["items" => array('1', '2', '3', '4', '5')]);
})->middleware('auth');;

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [Login::class, 'registration']);

Route::post('/login', [Login::class, 'login']);

Route::get('/login', function () {
    return view('login');
});

Route::get('/', function () {
    return view('index');
});


