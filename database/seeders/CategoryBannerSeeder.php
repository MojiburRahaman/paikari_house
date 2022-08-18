<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryBanner;
use Illuminate\Database\Seeder;

class CategoryBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $cat = Category::all()->pluck('id');
        foreach(range(1,50) as $index){
            $company = CategoryBanner::create([
                'category_id' =>$faker->randomElement($cat),
                'banner' => 'smartphones-cell-phones-4e.webp',
            ]);
        }
    }
}
