<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

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

    public function file(){
        return $this->belongsTo(File::class);
    }

    public function authors(){
        return $this->belongsToMany(Author::class, 'book_author');
    }
}
