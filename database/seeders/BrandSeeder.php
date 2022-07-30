<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach (range(1, 20) as $index) {
            $title =  $faker->text(15);
            $company = Brand::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'thumbnail' => 'maxime-ipsum-exercit-6Vf.webp',
            ]);
        }
    }
}
