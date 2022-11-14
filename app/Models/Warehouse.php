<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Warehouse extends Model
{
//    public int $id;
//    public string $name;

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
}