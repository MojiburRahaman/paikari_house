<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
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
        foreach(range(1,70) as $index){
            $title =  $faker->text(20);
            $company = SubCategory::create([
                'category_id' =>$faker->randomElement($cat),
                'title' => $title,
                'slug' => Str::slug($title),
            ]);
        }
    }
}
