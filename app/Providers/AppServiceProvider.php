<?php

namespace App\Providers;

use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
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
        view()->composer(['web.booking.index','web.layout.search', 'web.home.price-table', 'admin-page.route'], function ($view) {
            $nextdate = Carbon::now()->addDays(1)->format('d-m-Y');
            $key = md5(vsprintf('%s.%s.%s', [
                'web',
                'all',
                'provinces'
            ]));

            $provinces = Cache::remember($key, 1000, function () {
                return Province::all();
            });
            $view->with(['provinces'=>$provinces, 'nextdate'=>$nextdate]);
        });

        view()->composer(['admin.layout.top_nav'], function ($view) {
            $admin = getAuthAdmin();
            $brand = $admin->brand;
            $notifications = $brand ? $brand->notifications()->where('data->type', 'ticket')->get() : [];
            $view->with(['notifications'=>$notifications]);
        });
    }
}
