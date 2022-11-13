<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Book extends Model
{
//    public int $id;
//    public string $name;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'article_number',
        'name',
        'description',
        'picture_link',
        'purchase_price',
        'sale_price'
    ];
}
