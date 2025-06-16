<?php

namespace Database\Seeders;

use App\Models\Identitas;
use Illuminate\Database\Seeder;

class IdentitasSeeder extends Seeder
{
    public function run(): void
    {
        $identitasData = [
            [
                'nama_identitas' => 'Koperasi Sejahtera',
                'badan_hukum' => 'PT. Koperasi Sejahtera Indonesia',
                'npwp' => '12.345.678.9-123.000',
                'email' => 'info@koperasisejahtera.com',
                'url' => 'https://koperasisejahtera.com',
                'alamat' => 'Jl. Pahlawan No. 123, Jakarta Selatan',
                'telp' => '021-12345678',
                'fax' => '021-87654321',
                'foto' => 'identitas_foto/logo1.png',
            ],
            [
                'nama_identitas' => 'Koperasi Mandiri',
                'badan_hukum' => 'PT. Koperasi Mandiri Sentosa',
                'npwp' => '23.456.789.0-234.000',
                'email' => 'info@koperasimandiri.com',
                'url' => 'https://koperasimandiri.com',
                'alamat' => 'Jl. Merdeka No. 45, Jakarta Pusat',
                'telp' => '021-23456789',
                'fax' => '021-98765432',
                'foto' => 'identitas_foto/logo2.png',
            ],
            [
                'nama_identitas' => 'Koperasi Makmur Jaya',
                'badan_hukum' => 'PT. Koperasi Makmur Jaya Abadi',
                'npwp' => '34.567.890.1-345.000',
                'email' => 'info@koperasimakmurjaya.com',
                'url' => 'https://koperasimakmurjaya.com',
                'alamat' => 'Jl. Jenderal Sudirman No. 78, Jakarta Barat',
                'telp' => '021-34567890',
                'fax' => '021-09876543',
                'foto' => 'identitas_foto/logo3.png',
            ],
            [
                'nama_identitas' => 'Koperasi Barokah',
                'badan_hukum' => 'PT. Koperasi Barokah Indonesia',
                'npwp' => '45.678.901.2-456.000',
                'email' => 'info@koperasibarokah.com',
                'url' => 'https://koperasibarokah.com',
                'alamat' => 'Jl. Hayam Wuruk No. 90, Jakarta Pusat',
                'telp' => '021-45678901',
                'fax' => '021-10987654',
                'foto' => 'identitas_foto/logo4.png',
            ],
            [
                'nama_identitas' => 'Koperasi Berkah Sentosa',
                'badan_hukum' => 'PT. Koperasi Berkah Sentosa Makmur',
                'npwp' => '56.789.012.3-567.000',
                'email' => 'info@koperasiberkahsentosa.com',
                'url' => 'https://koperasiberkahsentosa.com',
                'alamat' => 'Jl. Gatot Subroto No. 56, Jakarta Selatan',
                'telp' => '021-56789012',
                'fax' => '021-21098765',
                'foto' => 'identitas_foto/logo5.png',
            ],
            [
                'nama_identitas' => 'Koperasi Mitra Usaha',
                'badan_hukum' => 'PT. Koperasi Mitra Usaha Bersama',
                'npwp' => '67.890.123.4-678.000',
                'email' => 'info@koperasimitrausaha.com',
                'url' => 'https://koperasimitrausaha.com',
                'alamat' => 'Jl. Diponegoro No. 34, Jakarta Pusat',
                'telp' => '021-67890123',
                'fax' => '021-32109876',
                'foto' => 'identitas_foto/logo6.png',
            ],
            [
                'nama_identitas' => 'Koperasi Karya Bersama',
                'badan_hukum' => 'PT. Koperasi Karya Bersama Indonesia',
                'npwp' => '78.901.234.5-789.000',
                'email' => 'info@koperasikaryabersama.com',
                'url' => 'https://koperasikaryabersama.com',
                'alamat' => 'Jl. Imam Bonjol No. 67, Jakarta Pusat',
                'telp' => '021-78901234',
                'fax' => '021-43210987',
                'foto' => 'identitas_foto/logo7.png',
            ],
            [
                'nama_identitas' => 'Koperasi Maju Mapan',
                'badan_hukum' => 'PT. Koperasi Maju Mapan Jaya',
                'npwp' => '89.012.345.6-890.000',
                'email' => 'info@koperasimajumapan.com',
                'url' => 'https://koperasimajumapan.com',
                'alamat' => 'Jl. Thamrin No. 89, Jakarta Pusat',
                'telp' => '021-89012345',
                'fax' => '021-54321098',
                'foto' => 'identitas_foto/logo8.png',
            ],
            [
                'nama_identitas' => 'Koperasi Abadi Jaya',
                'badan_hukum' => 'PT. Koperasi Abadi Jaya Makmur',
                'npwp' => '90.123.456.7-901.000',
                'email' => 'info@koperasiabadisjaya.com',
                'url' => 'https://koperasiabadjaya.com',
                'alamat' => 'Jl. Cikini No. 45, Jakarta Pusat',
                'telp' => '021-90123456',
                'fax' => '021-65432109',
                'foto' => 'identitas_foto/logo9.png',
            ],
            [
                'nama_identitas' => 'Koperasi Lestari Makmur',
                'badan_hukum' => 'PT. Koperasi Lestari Makmur Sejahtera',
                'npwp' => '01.234.567.8-012.000',
                'email' => 'info@koperasilestarimarkmur.com',
                'url' => 'https://koperasilestarimarkmur.com',
                'alamat' => 'Jl. Kebon Sirih No. 78, Jakarta Pusat',
                'telp' => '021-01234567',
                'fax' => '021-76543210',
                'foto' => 'identitas_foto/logo10.png',
            ],
        ];

        // Insert semua data
        foreach ($identitasData as $data) {
            Identitas::create($data);
        }
    }
}
