<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;
    
    // public function before(Admin $admin)
    // {
    //     if ($admin->isSuperAdmin()) {
    //         return true;
    //     }
    // }
    /**
     * Determine whether the user can view any roles.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can view the role.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function view(Admin $admin, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.create_role.slug'));
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function update(Admin $admin, Role $role)
    {
        return $admin->hasAccess(config('permissions.update_role.slug')) && $admin->id === $role->admin_id;
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function delete(Admin $admin, Role $role)
    {
        if ($role->slug === 'super-admin') {
            return false;
        }
        return $admin->hasAccess(config('permissions.delete_role.slug')) && $admin->id === $role->admin_id;
    }

    /**
     * Determine whether the user can restore the role.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function restore(Admin $admin, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the role.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Role  $role
     * @return mixed
     */
    public function forceDelete(Admin $admin, Role $role)
    {
        //
    }
}
