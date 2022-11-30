<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Warehouse extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'country',
        'region',
        'city',
        'street',
        'house',
        'building',
        'flat',
    ];

    public function books(){
        return $this->belongsToMany(Book::class, 'book_warehouse');
    }
}
