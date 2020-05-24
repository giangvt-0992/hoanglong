<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\TripDepartDate;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripDepartDatePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the admin can view any trip depart dates.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.view_trip_depart_date.slug'));
    }

    /**
     * Determine whether the admin can view the trip depart date.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\TripDepartDate  $tripDepartDate
     * @return mixed
     */
    public function view(Admin $admin, TripDepartDate $tripDepartDate)
    {
        //
    }

    /**
     * Determine whether the admin can create trip depart dates.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.create_trip_depart_date.slug'));
    }

    /**
     * Determine whether the admin can update the trip depart date.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\TripDepartDate  $tripDepartDate
     * @return mixed
     */
    public function update(Admin $admin, TripDepartDate $tripDepartDate)
    {
        return $admin->brand_id === $tripDepartDate->brand_id && $admin->hasAccess(config('permissions.update_trip_depart_date.slug'));
    }

    /**
     * Determine whether the admin can delete the trip depart date.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\TripDepartDate  $tripDepartDate
     * @return mixed
     */
    public function delete(Admin $admin, TripDepartDate $tripDepartDate)
    {
        return $admin->brand_id === $tripDepartDate->brand_id && $admin->hasAccess(config('permissions.delete_trip_depart_date.slug'));
    }

    /**
     * Determine whether the admin can restore the trip depart date.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\TripDepartDate  $tripDepartDate
     * @return mixed
     */
    public function restore(Admin $admin, TripDepartDate $tripDepartDate)
    {
        //
    }

    /**
     * Determine whether the admin can permanently delete the trip depart date.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\TripDepartDate  $tripDepartDate
     * @return mixed
     */
    public function forceDelete(Admin $admin, TripDepartDate $tripDepartDate)
    {
        //
    }
}
