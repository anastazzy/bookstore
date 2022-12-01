<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public function statuses() {
        return $this->hasOne(Status::class, 'status_id');
    }

    public function books(){
        return $this->belongsToMany(Book::class, 'order_book')->withPivot('count');
    }
}
