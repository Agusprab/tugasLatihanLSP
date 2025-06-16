<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil semua seeder secara berurutan
        $this->call([
            UserSeeder::class,
            IdentitasSeeder::class,
            ItemSeeder::class,
            CustomerSeeder::class,
            // Tambahkan seeder lain sesuai kebutuhan
        ]);
    }
}
