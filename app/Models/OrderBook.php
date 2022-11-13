<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
