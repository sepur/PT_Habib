<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Impor Hash

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'User Admin',
                'email' => 'admin@example.com',
                'username' => 'admin',
                'password' => Hash::make("12345678"), // Gunakan Hash::make
            ]
        ]);
    }
}

