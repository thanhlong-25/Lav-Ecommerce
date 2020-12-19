<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        //UserCustomer::truncate(); // xoá database đang có
        for($i = 0; $i < 10; $i++){
        $brand = Brand::create([
            'brand_name' => $faker->lastName,
            'brand_description' => $faker->catchPhrase,
            'brand_status' => $faker->numberBetween($min = 0, $max = 1),
            'created_at' => now(),
        ]);}
    }
}
