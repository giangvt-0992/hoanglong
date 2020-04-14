<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $models = [
        'Route',
        'Province',
        'User',
        'Ticket',
        'TripDepartDate',
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->models as $model) {
            $contract = 'App\Contracts\Repositories\\' . $model . 'Repository';
            $repository = 'App\Repositories\Eloquents\Eloquent' . $model . 'Repository';
            $this->app->bind($contract, $repository);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
