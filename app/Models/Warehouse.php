<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * App\Models\Warehouse
 *
 * @property int $id
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $street
 * @property int $house
 * @property string|null $building
 * @property int $flat
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read int|null $books_count
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereBuilding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereFlat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereHouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereStreet($value)
 * @mixin \Eloquent
 */
class Warehouse extends Model
{
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

    public function books(){
        return $this->belongsToMany(Book::class, 'book_warehouse');
    }
}
