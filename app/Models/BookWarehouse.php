<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * App\Models\BookWarehouse
 *
 * @property int $id
 * @property int $book_id
 * @property int $warehouse_id
 * @property int $count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read int|null $books_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Warehouse[] $warehouses
 * @property-read int|null $warehouses_count
 * @method static \Illuminate\Database\Eloquent\Builder|BookWarehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookWarehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookWarehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookWarehouse whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookWarehouse whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookWarehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookWarehouse whereWarehouseId($value)
 * @mixin \Eloquent
 */
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

    protected $table = "book_warehouse";

    public function books(){
        return$this->hasMany(Book::class);
    }

    public function warehouses(){
        return$this->hasMany(Warehouse::class);
    }
}
