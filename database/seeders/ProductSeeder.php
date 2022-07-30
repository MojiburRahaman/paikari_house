<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $vend = Vendor::all()->pluck('id');
        $cat = Category::all()->pluck('id');
        $scat = SubCategory::all()->pluck('id');
        $brand = Brand::all()->pluck('id');
        foreach (range(1, 200) as $index) {
            $title =  $faker->text(35);
            $discount = $faker->randomDigit;
            $price = $faker->randomDigit;
            $discount_amount = ($price * $discount) / 100;
            $sale = round($price - $discount_amount);

            $company = Product::create([
                'category_id' => $faker->randomElement($cat),
                'subcatagory_id' => $faker->randomElement($scat),
                'vendor_id' => $faker->randomElement($vend),
                'brand_id' => $faker->randomElement($brand),
                'title' => $title,
                'meta_description' => $title,
                'meta_keyword' => $title,
                'slug' => Str::slug($title),
                'discount' => $discount,
                'regular_price' => $price,
                'sale_price' => $sale,
                'thumbnail_img' => 'plus-size-5xl-2019-new-summer-mens-short-sleeve-hawaiian-shirts-cotton-casual-floral-shirts-wave-regular-mens-clothing-fashion-z.webp',
                'product_summary' =>  $faker->text(250),
                'product_description' =>  $faker->text(2000),

            ]);
        }
    }
}
