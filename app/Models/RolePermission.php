<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RolePermission extends Model
{
//    public int $id;
//    public int $roleId;
//    public int $permissionId;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'roleId',
        'permissionId'
    ];
}
