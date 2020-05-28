<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\District;
use Illuminate\Auth\Access\HandlesAuthorization;

class DistrictPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the Admin can view any districts.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.view_district.slug'));
    }

    /**
     * Determine whether the Admin can view the district.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\=Models\District  $district
     * @return mixed
     */
    public function view(Admin $admin, District $district)
    {
        // return $admin->hasAccess(config('permissions.create_district.slug'));
    }

    /**
     * Determine whether the Admin can create districts.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.create_district.slug'));
    }

    /**
     * Determine whether the Admin can update the district.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\=Models\District  $district
     * @return mixed
     */
    public function update(Admin $admin, District $district)
    {
        return $admin->hasAccess(config('permissions.update_district.slug'));
    }

    /**
     * Determine whether the Admin can delete the district.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\=Models\District  $district
     * @return mixed
     */
    public function delete(Admin $admin, District $district)
    {
        return $admin->hasAccess(config('permissions.delete_district.slug'));
    }

    /**
     * Determine whether the Admin can restore the district.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\=Models\District  $district
     * @return mixed
     */
    public function restore(Admin $admin, District $district)
    {
        //
    }

    /**
     * Determine whether the Admin can permanently delete the district.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\=Models\District  $district
     * @return mixed
     */
    public function forceDelete(Admin $admin, District $district)
    {
        //
    }
}
