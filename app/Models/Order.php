<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Order extends Model
{
//    public int $id;
//    public string $name;

    public $timestamps = false;

    protected $casts = [
        'placing_date' => 'datetime',
        'sale_date' => 'datetime',
        'receipt_date' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'status_id',
        'placing_date',
        'sale_date',
        'receipt_date'
    ];

    public function statuses(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->hasMany(Status::class);
    }
}
