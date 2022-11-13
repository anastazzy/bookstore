<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BookGenre extends Model
{
//    public int $id;
//    public string $name;

    public $timestamps = false;

    protected $fillable = [
        'book_id',
        'genre_id',
    ];

    public function boooks(){
        return $this->hasMany(Book::class);
    }

    public function genres(){
        return $this->hasMany(Genre::class);
    }
}
