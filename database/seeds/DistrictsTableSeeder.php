<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districtsJson = Config::get('districts');
        $districts = json_decode($districtsJson, true);
        $insertData = collect($districts);

        $chunks = $insertData->chunk(200);
        foreach ($chunks as $chunk) {
            DB::table('districts')->insert($chunk->toArray());
        }
    }
}
