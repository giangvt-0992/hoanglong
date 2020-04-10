<?php

use App\Models\Trip;
use App\Models\TripDepartDate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripDepartDateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trips = Trip::with('carType:id,total_seats,seat_map')->get();
        $maxDays=date('t');
        $currentDay=date('j');
        $currentMonth=date('m');
        $currentYear=date('Y');
        $array = [];
        foreach ($trips as $trip) {
            $trip = [
                    'brand_id' => $trip->brand_id,
                    'trip_id' => $trip->id,
                    'available_seats' => $trip->carType->total_seats,
                    'seat_map' => $trip->carType->seat_map,
                ];
            for ($i = $currentDay; $i <= $maxDays; $i++) {
                $new = $trip;
                $new['depart_date'] = "$currentYear-$currentMonth-$i";
                $array[] = $new;
            }
        }
        $insertData = collect($array);
        $chunks = $insertData->chunk(200);
        foreach ($chunks as $chunk) {
            DB::table('trip_depart_dates')->insert($chunk->toArray());
        }
    }
}
