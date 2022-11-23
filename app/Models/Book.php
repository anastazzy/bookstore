<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'name',
        'file_id',
        'description',
        'purchase_price',
        'sale_price'
    ];

    public function file(){
        return $this->belongsTo(File::class);
    }

    public function authors(){
        return $this->belongsToMany(Author::class, 'book_author');
    }

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_book');
    }

    public function warehouses(){
        return $this->belongsToMany(Warehouse::class, 'book_warehouse')->withPivot('count');
    }

    public function genres(){
        return $this->belongsToMany(Genre::class, 'book_genre');
    }
}
