<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SyncRolesAndPermissions extends Command
{
    protected $signature = 'sync:roles-permissions';
    protected $description = 'Sync existing roles and permissions with Spatie roles and permissions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Syncing roles and permissions...');

        // Sync Roles
        $existingRoles = DB::table('roles')->get();
        foreach ($existingRoles as $role) {
            Role::updateOrCreate(
                ['name' => $role->name],
                ['guard_name' => 'web'] // Adjust if you use a different guard
            );
        }

        // Sync Permissions
        $existingPermissions = DB::table('permissions')->get();
        foreach ($existingPermissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission->name],
                ['guard_name' => 'web'] // Adjust if you use a different guard
            );
        }

        // Sync Role-Permission Relationships
        $rolePermissions = DB::table('role_has_permissions')->get();
        foreach ($rolePermissions as $rolePermission) {
            $role = Role::find($rolePermission->role_id);
            $permission = Permission::find($rolePermission->permission_id);
            
            if ($role && $permission) {
                $role->givePermissionTo($permission);
            }
        }

        // Sync User-Roles
        $userRoles = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.id as user_id', 'roles.name as role_name')
            ->get();
        
        foreach ($userRoles as $userRole) {
            $user = User::find($userRole->user_id);
            $role = Role::where('name', $userRole->role_name)->first();
            
            if ($user && $role) {
                $user->assignRole($role);
            }
        }

        $this->info('Roles and permissions synced successfully!');
    }
}
