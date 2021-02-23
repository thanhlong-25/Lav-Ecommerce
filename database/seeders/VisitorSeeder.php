<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VisitorSeeder extends Seeder
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
        for($i = 0; $i < 80; $i++){
        Visitor::create([
            'visitor_ip' => $faker->ipv4,
            'visitor_date' => $faker->dateTimeThisYear($max = 'now', $timezone = null),
        ]);}
    }
}
