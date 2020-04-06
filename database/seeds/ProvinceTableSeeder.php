<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $province_json = Config::get('provinces');
        $provinces = json_decode($province_json);
        foreach ($provinces as $province) {
            DB::table('provinces')->insert([
                'name' =>  $province->Title,
                'slug' => $province->SolrID,
            ]);
        }
    }
}
