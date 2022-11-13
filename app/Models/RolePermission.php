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

    public function roles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function permissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Permission::class);
    }
}
