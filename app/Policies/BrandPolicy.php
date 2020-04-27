<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Brand;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
{
    use HandlesAuthorization;

    public function before(Admin $admin)
    {
        if ($admin->isSuperAdmin()) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any brands.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.view_brand.slug'));
    }

    /**
     * Determine whether the user can view the brand.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\App\Models\Brand  $brand
     * @return mixed
     */
    public function view(Admin $admin, Brand $brand)
    {
        // return $admin->hasAccess(config('permissions.create_brand.slug')) && $admin->brand_id === $brand->id;
    }

    /**
     * Determine whether the user can create brands.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.create_brand.slug'));
    }

    /**
     * Determine whether the user can update the brand.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\App\Models\Brand  $brand
     * @return mixed
     */
    public function update(Admin $admin, Brand $brand)
    {
        return $admin->hasAccess(config('permissions.update_brand.slug')) && $admin->brand_id === $brand->id;
    }

    /**
     * Determine whether the user can delete the brand.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\App\Models\Brand  $brand
     * @return mixed
     */
    public function delete(Admin $admin, Brand $brand)
    {
        return $admin->hasAccess(config('permissions.delete_brand.slug')) && $admin->brand_id === $brand->id;
    }

    /**
     * Determine whether the user can restore the brand.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\App\Models\Brand  $brand
     * @return mixed
     */
    public function restore(Admin $admin, Brand $brand)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the brand.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\App\Models\Brand  $brand
     * @return mixed
     */
    public function forceDelete(Admin $admin, Brand $brand)
    {
        //
    }
}
