<?php

namespace Database\Seeders;

use App\Models\UserCustomer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class UserCustomerSeeder extends Seeder
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
        for($i = 0; $i < 5; $i++){
        $customer = UserCustomer::create([
            'customer_name' => $faker->username,
            'customer_email' => $faker->email,
            'customer_password' => md5($faker->password),
            'customer_phone' => $faker->phoneNumber,
        ]);}
    }
}
