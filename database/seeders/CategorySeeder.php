<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
// use Faker\Generator as Faker; 
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        foreach(range(1,15) as $index){
            $title =  $faker->text(15);
            $company = Category::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'thumbnail' =>'beauty-health-r.png',
                'discount_thumbnail' =>'beauty-health-cF.jpg',
            ]);
        }
    }
}
