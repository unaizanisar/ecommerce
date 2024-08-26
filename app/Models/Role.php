<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole; 
class Role extends SpatieRole
{
    use HasFactory;
    protected $fillable = [
        'name',
        'guard_name',
        'status',
    ];
    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id', 'permission_id');
    // }
} 
