<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * App\Models\OrderBook
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read int|null $books_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|OrderBook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderBook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderBook query()
 * @mixin \Eloquent
 */
class OrderBook extends Model
{
//    public int $id;
//    public string $name;

    public $timestamps = false;

    protected $casts = [
    ];

    protected $fillable = [
        'order_id',
        'book_id',
        'count',
    ];

    public function books(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }
}
