<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Route;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoutePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any routes.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.view_route.slug'));
    }

    /**
     * Determine whether the user can view the route.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Route  $route
     * @return mixed
     */
    public function view(Admin $admin, Route $route)
    {
        //
    }

    /**
     * Determine whether the user can create routes.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.create_route.slug'));
    }

    /**
     * Determine whether the user can update the route.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Route  $route
     * @return mixed
     */
    public function update(Admin $admin, Route $route)
    {
        return $admin->hasAccess(config('permissions.update_route.slug')) && $admin->brand_id === $route->brand_id;
    }

    /**
     * Determine whether the user can delete the route.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Route  $route
     * @return mixed
     */
    public function delete(Admin $admin, Route $route)
    {
        return $admin->hasAccess(config('permissions.delete_route.slug')) && $admin->brand_id === $route->brand_id;
    }

    /**
     * Determine whether the user can restore the route.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Route  $route
     * @return mixed
     */
    public function restore(Admin $admin, Route $route)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the route.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Route  $route
     * @return mixed
     */
    public function forceDelete(Admin $admin, Route $route)
    {
        //
    }
}
