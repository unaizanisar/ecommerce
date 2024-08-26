<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;
class Permission extends SpatiePermission
{
    use HasFactory;
    protected $fillable = [
        'name',
        'module',
        'guard_name',
        'status',
    ];
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'role_has_permissions', 'permission_id', 'role_id');
    // }
}