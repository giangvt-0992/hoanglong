<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Trip;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any trips.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.view_trip.slug'));
    }

    /**
     * Determine whether the user can view the trip.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Trip  $trip
     * @return mixed
     */
    public function view(Admin $admin, Trip $trip)
    {
    }

    /**
     * Determine whether the user can create trips.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.create_trip.slug'));
    }

    /**
     * Determine whether the user can update the trip.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Trip  $trip
     * @return mixed
     */
    public function update(Admin $admin, Trip $trip)
    {
        return $admin->hasAccess(config('permissions.update_trip.slug')) && $admin->brand_id === $trip->brand_id;
    }

    /**
     * Determine whether the user can delete the trip.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Trip  $trip
     * @return mixed
     */
    public function delete(Admin $admin, Trip $trip)
    {
        return $admin->hasAccess(config('permissions.delete_trip.slug')) && $admin->brand_id === $trip->brand_id;
    }

    /**
     * Determine whether the user can restore the trip.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Trip  $trip
     * @return mixed
     */
    public function restore(Admin $admin, Trip $trip)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the trip.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Trip  $trip
     * @return mixed
     */
    public function forceDelete(Admin $admin, Trip $trip)
    {
        //
    }
}
