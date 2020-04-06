<?php

use App\Models\Route;
use App\Models\Trip;
use Illuminate\Database\Seeder;

class TripsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = Route::all();

        $var = [];
        foreach ($routes as $route) {
            $var = [
                'route_id' => $route->id,
            ];
            factory(Trip::class, 5)->create($var);
        }
    }
}
