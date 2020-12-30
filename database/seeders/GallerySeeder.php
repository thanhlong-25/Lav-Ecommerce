<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $product = Product::all()->pluck('product_id')->toArray();
        //UserCustomer::truncate(); // xoá database đang có~
        for($i = 0; $i < 20; $i++){
        Gallery::create([
            'product_id' => $faker->randomElement($product),
            'gallery_image' => $faker->imageUrl($width = 640, $height = 480),
            'created_at' => now(),
        ]);}
    }
}
