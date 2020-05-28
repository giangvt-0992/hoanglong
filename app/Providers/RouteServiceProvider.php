<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\District;
use App\Models\Place;
use App\Models\Province;
use App\Models\Role;
use App\Models\Route as ModelsRoute;
use App\Models\Trip;
use App\Models\TripDepartDate;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();

        Route::bind('brand', function ($value) {
            return Brand::findOrFail($value);
        });
        Route::bind('role', function ($value) {
            return Role::findOrFail($value);
        });
        Route::bind('admin', function ($value) {
            return Admin::findOrFail($value);
        });
        Route::bind('place', function ($value) {
            return Place::findOrFail($value);
        });
        Route::bind('trip', function ($value) {
            return Trip::findOrFail($value);
        });
        Route::bind('route', function ($value) {
            return ModelsRoute::findOrFail($value);
        });
        Route::bind('tripDepartDate', function ($value) {
            return TripDepartDate::findOrFail($value);
        });
        Route::bind('province', function ($value) {
            return Province::findOrFail($value);
        });
        Route::bind('district', function ($value) {
            return District::findOrFail($value);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/admin.php'));
    }
}
