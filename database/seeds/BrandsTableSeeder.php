<?php

use App\Models\Brand;
use App\Models\Image;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Image::class, 50)->create();
        factory(Brand::class, 10)->create();

        $brands = Brand::all();
        $images = Image::all()->pluck('id')->toArray();
        foreach ($brands as $brand) {
            $randomImage = array_rand($images, 5);
            $brand->images()->attach($randomImage);
        }
    }
}
