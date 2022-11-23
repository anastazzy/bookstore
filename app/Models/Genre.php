<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Genre extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function books(){
        return $this->belongsToMany(Book::class);
    }
}
