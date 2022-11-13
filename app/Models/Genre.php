<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Genre extends Model
{
    public int $id;
    public string $name;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
