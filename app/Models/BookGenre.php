<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * App\Models\BookGenre
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $boooks
 * @property-read int|null $boooks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Genre[] $genres
 * @property-read int|null $genres_count
 * @method static \Illuminate\Database\Eloquent\Builder|BookGenre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookGenre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookGenre query()
 * @mixin \Eloquent
 */
class BookGenre extends Model
{
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
