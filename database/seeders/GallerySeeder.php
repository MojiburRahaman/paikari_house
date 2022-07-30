<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $cat = Product::all()->pluck('id');
        foreach (range(1, 400) as $index) {
            $title =  $faker->text(20);
            $company = Gallery::create([
                'product_id' => $faker->randomElement($cat),
                'product_image' => 'plus-size-5xl-2019-new-summer-mens-short-sleeve-hawaiian-shirts-cotton-casual-floral-shirts-wave-regular-mens-clothing-fashion-um.webp',
            ]);
        }
    }
}
