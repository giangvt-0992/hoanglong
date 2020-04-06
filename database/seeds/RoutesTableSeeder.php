<?php

use App\Models\Brand;
use App\Models\Route;
use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands  = Brand::all()->pluck('id');

        foreach ($brands as $brand) {
            factory(Route::class, 15)->create(['brand_id' => $brand]);
        }
    }
}
