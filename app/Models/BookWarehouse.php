<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BookWarehouse extends Model
{
//    public int $id;
//    public string $name;

    public $timestamps = false;

    protected $fillable = [
        'book_id',
        'warehouse_id',
        'count',
    ];

    public function books(){
        return$this->hasMany(Book::class);
    }

    public function warehouses(){
        return$this->hasMany(Warehouse::class);
    }
}
