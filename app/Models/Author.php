<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * App\Models\Author
 *
 * @property int $id
 * @property string $last_name
 * @property string $first_name
 * @property string|null $patronymic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read int|null $books_count
 * @method static \Illuminate\Database\Eloquent\Builder|Author newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author query()
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author wherePatronymic($value)
 * @mixin \Eloquent
 */
class Author extends Model
{
//    public int $id;
//    public string $name;

    public $timestamps = false;

    protected $fillable = [
        'last_name',
        'first_name',
        'patronymic',
    ];

    public function books(){
        return $this->belongsToMany(Book::class);
    }
}
