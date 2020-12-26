<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CateSeeder extends Seeder
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
            $cate = Category::create([
                'cate_name' => $faker->lastName,
                'cate_status' => $faker->numberBetween($min = 0, $max = 1),
                'created_at' => now(),
            ]);}
    }
}
