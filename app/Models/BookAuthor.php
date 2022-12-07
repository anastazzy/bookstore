<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * App\Models\BookAuthor
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Author[] $authors
 * @property-read int|null $authors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read int|null $books_count
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor query()
 * @mixin \Eloquent
 */
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
