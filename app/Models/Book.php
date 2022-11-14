<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Book extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'article_number',
        'file_id',
        'description',
        'purchase_price',
        'sale_price'
    ];
}
