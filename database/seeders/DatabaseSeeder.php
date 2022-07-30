<?php

namespace Database\Seeders;

use App\Models\CategoryBanner;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Category::factory(10)->create();
        
        $this->call([
            // CategorySeeder::class,
            // BrandSeeder::class,
            // CategoryBannerSeeder::class,
            // SubCategorySeeder::class,
            GallerySeeder::class,
            // ProductSeeder::class,
        ]);

    }
}
