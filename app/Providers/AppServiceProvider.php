<?php

namespace App\Providers;

use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['web.home.index', 'web.home.booking', 'web.home.price-table', 'admin-page.route'], function ($view) {
            $nextdate = Carbon::now()->addDays(1)->format('d-m-Y');
            $provinces = Province::all();
            $view->with(['provinces'=>$provinces, 'nextdate'=>$nextdate]);
        });
    }
}
