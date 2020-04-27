<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Place;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlacePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any places.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.view_place.slug'));
    }

    /**
     * Determine whether the user can view the place.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Place  $place
     * @return mixed
     */
    public function view(Admin $admin, Place $place)
    {
        
    }

    /**
     * Determine whether the user can create places.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.create_place.slug'));
    }

    /**
     * Determine whether the user can update the place.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Place  $place
     * @return mixed
     */
    public function update(Admin $admin, Place $place)
    {
        return $admin->hasAccess(config('permissions.update_place.slug')) && $admin->brand_id === $place->brand_id;
    }

    /**
     * Determine whether the user can delete the place.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Place  $place
     * @return mixed
     */
    public function delete(Admin $admin, Place $place)
    {
        return $admin->hasAccess(config('permissions.delete_place.slug')) && $admin->brand_id === $place->brand_id;
    }

    /**
     * Determine whether the user can restore the place.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Place  $place
     * @return mixed
     */
    public function restore(Admin $admin, Place $place)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the place.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Place  $place
     * @return mixed
     */
    public function forceDelete(Admin $admin, Place $place)
    {
        //
    }
}
