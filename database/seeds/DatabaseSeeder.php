<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProvinceTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(TypeCarsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(PlacesTableSeeder::class);
        $this->call(RoutesTableSeeder::class);
        $this->call(TripsTableSeeder::class);
        $this->call(TripDepartDateTableSeeder::class);
    }
}
