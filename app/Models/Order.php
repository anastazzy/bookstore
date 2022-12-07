<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $status_id
 * @property \Illuminate\Support\Carbon|null $placing_date
 * @property \Illuminate\Support\Carbon $sale_date
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read int|null $books_count
 * @property-read \App\Models\Status|null $status
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePlacingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereSaleDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    public $timestamps = false;

    protected $casts = [
        'placing_date' => 'datetime',
        'sale_date' => 'datetime',
        'receipt_date' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'placing_date',
        'sale_date',
        'receipt_date'
    ];

    public function status() {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function books(){
        return $this->belongsToMany(Book::class, 'order_book')->withPivot('count');
    }

  public function user(){
    return $this->hasOne(User::class, 'id', 'user_id');
  }
}
