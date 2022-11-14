<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BookAuthor extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'book_id',
        'author_id',
    ];

    public function books(){
        return $this->hasMany(Book::class);
    }

    public function authors(){
        return $this->hasMany(Author::class);
    }
}
