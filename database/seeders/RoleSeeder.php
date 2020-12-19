<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
            'role_name' => 'Author',
        ]);

        Roles::create([
            'role_name' => 'Admin',
        ]);

        Roles::create([
            'role_name' => 'User',
        ]);
    }
}
