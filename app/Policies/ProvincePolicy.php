<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Province;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProvincePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the Admin can view any provinces.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.view_province.slug'));
    }

    /**
     * Determine whether the Admin can view the province.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Province  $province
     * @return mixed
     */
    public function view(Admin $admin, Province $province)
    {
        //
    }

    /**
     * Determine whether the Admin can create provinces.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.create_province.slug'));
    }

    /**
     * Determine whether the Admin can update the province.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Province  $province
     * @return mixed
     */
    public function update(Admin $admin, Province $province)
    {
        return $admin->brand_id === $province->brand_id && $admin->hasAccess(config('permissions.update_province.slug'));
    }

    /**
     * Determine whether the Admin can delete the province.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Province  $province
     * @return mixed
     */
    public function delete(Admin $admin, Province $province)
    {
        return $admin->brand_id === $province->brand_id && $admin->hasAccess(config('permissions.delete_province.slug'));
    }

    /**
     * Determine whether the Admin can restore the province.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Province  $province
     * @return mixed
     */
    public function restore(Admin $admin, Province $province)
    {
        //
    }

    /**
     * Determine whether the Admin can permanently delete the province.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Province  $province
     * @return mixed
     */
    public function forceDelete(Admin $admin, Province $province)
    {
        //
    }
}
