<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@koperasi.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Tambahkan beberapa user lagi
        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@koperasi.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);
    }
}
