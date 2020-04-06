<?php

use App\Models\CarType;
use Illuminate\Database\Seeder;

class TypeCarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arraySeat = config('seatmap');
        foreach ($arraySeat as $key => $value) {
            $carType = new CarType();
            $carType->name = "Xe $key chỗ";
            $carType->slug = "xe-$key-cho";
            $carType->total_seats = $key;
            $carType->seat_map = $value;
            $carType->save();
        }
    }
}
