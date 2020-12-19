<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $brand = Brand::all()->pluck('brand_id')->toArray();
        $cate = Category::all()->pluck('cate_id')->toArray();
        //UserCustomer::truncate(); // xoá database đang có~
        for($i = 0; $i < 20; $i++){
        $product = Product::create([
            'product_name' => $faker->lastName,
            'cate_id' => $faker->randomElement($cate),
            'brand_id' =>$faker->randomElement($brand),
            'product_description' => $faker->catchPhrase,
            'product_inventory' => $faker->numberBetween($min = 10, $max = 200),
            'product_sold' => '0',
            'product_image' => $faker->imageUrl($width = 640, $height = 480),
            'product_price' => $faker->numberBetween($min = 100000, $max = 99999999),
            'product_status' => $faker->numberBetween($min = 0, $max = 1),
            'created_at' => now(),
        ]);}
    }
}
