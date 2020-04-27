<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;
    
    // public function before(Admin $admin)
    // {
    //     if ($admin->isSuperAdmin()) {
    //         return true;
    //     }
    // }
    /**
     * Determine whether the user can view any admins.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.view_admin.slug'));
    }

    /**
     * Determine whether the user can view the admin.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function view(Admin $adminLogin, Admin $admin)
    {
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(Admin $adminLogin)
    {
        return $adminLogin->hasAccess(config('permissions.create_admin.slug'));
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function update(Admin $adminLogin, Admin $admin)
    {
        return $adminLogin->hasAccess(config('permissions.update_admin.slug')) && $adminLogin->id === $admin->parent_id;
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function delete(Admin $adminLogin, Admin $admin)
    {
        return $adminLogin->hasAccess(config('permissions.delete_admin.slug')) && $adminLogin->id === $admin->parent_id;
    }

    /**
     * Determine whether the user can restore the admin.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function restore(User $user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the admin.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function forceDelete(User $user, Admin $admin)
    {
        //
    }
}
