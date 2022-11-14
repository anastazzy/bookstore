<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Author extends Model
{
//    public int $id;
//    public string $name;

    public $timestamps = false;

    protected $fillable = [
        'last_name',
        'first_name',
        'patronymic',
    ];

    public function books(){
        return $this->belongsToMany(Book::class);
    }
}
