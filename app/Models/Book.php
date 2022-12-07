<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Book
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $file_id
 * @property float $purchase_price
 * @property float $sale_price
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Author[] $authors
 * @property-read int|null $authors_count
 * @property-read \App\Models\File $file
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Genre[] $genres
 * @property-read int|null $genres_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Warehouse[] $warehouses
 * @property-read int|null $warehouses_count
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book wherePurchasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereSalePrice($value)
 * @mixin \Eloquent
 */
class Book extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'name',
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

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_book');
    }

    public function warehouses(){
        return $this->belongsToMany(Warehouse::class, 'book_warehouse')->withPivot('count');
    }

    public function genres(){
        return $this->belongsToMany(Genre::class, 'book_genre');
    }
}
