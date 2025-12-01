<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin UKM',
            'email' => 'admin@simasi.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);
    }
}
