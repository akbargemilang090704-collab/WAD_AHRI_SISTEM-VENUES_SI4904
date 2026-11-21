<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sistemvenue.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Akun Pelanggan
        User::create([
            'name' => 'Pelanggan Setia',
            'email' => 'pelanggan@sistemvenue.com',
            'password' => Hash::make('password123'),
            'role' => 'pelanggan',
        ]);
    }
}