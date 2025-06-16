<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Data manual (fixed data)
        $customers = [
            [
                'nama_customer' => 'PT Maju Bersama',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'telp' => '021-5550112',
                'fax' => '021-5550113',
                'email' => 'info@majubersama.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_customer' => 'CV Sejahtera Abadi',
                'alamat' => 'Jl. Gatot Subroto No. 45, Jakarta Selatan',
                'telp' => '021-6872234',
                'fax' => '021-6872235',
                'email' => 'contact@sejahteraabadi.co.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_customer' => 'Toko Makmur Jaya',
                'alamat' => 'Jl. Pasar Baru No. 78, Jakarta Pusat',
                'telp' => '021-3456789',
                'fax' => '021-3456790',
                'email' => 'tokojaya@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data manual
        foreach ($customers as $customer) {
            Customer::create($customer);
        }

        // Generate data tambahan dengan Faker (30 data)
        $prefixes = ['PT', 'CV', 'UD', 'Toko', 'Koperasi', 'Warung', 'PD', 'Firma', 'Restoran'];
        $suffixes = ['Sejahtera', 'Makmur', 'Jaya', 'Abadi', 'Sentosa', 'Barokah', 'Bersama', 'Mandiri', 'Utama', 'Berkah', 'Cemerlang'];
        $middleNames = ['Maju', 'Karya', 'Cipta', 'Sarana', 'Artha', 'Mega', 'Nusa', 'Prima', 'Indah', 'Raya', 'Baru', 'Lestari'];

        for ($i = 0; $i < 30; $i++) {
            $businessPrefix = $faker->randomElement($prefixes);
            $businessMiddle = $faker->boolean(70) ? $faker->randomElement($middleNames) . ' ' : '';
            $businessSuffix = $faker->randomElement($suffixes);

            $businessName = $businessPrefix . ' ' . $businessMiddle . $businessSuffix;

            Customer::create([
                'nama_customer' => $businessName,
                'alamat' => $faker->address,
                'telp' => $faker->phoneNumber,
                'fax' => $faker->boolean(60) ? $faker->phoneNumber : null, // 60% chance to have fax
                'email' => strtolower(str_replace(' ', '', explode(' ', $businessName)[0])) . '@' . $faker->safeEmailDomain,
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
