<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [

                'nama_item' => 'Beras Premium',
                'uom' => 'kg',
                'harga_beli' => 60000,
                'harga_jual' => 65000,

            ],
            [

                'nama_item' => 'Gula Pasir',
                'uom' => 'kg',
                'harga_beli' => 14000,
                'harga_jual' => 16000,

            ],
            [

                'nama_item' => 'Minyak Goreng',
                'uom' => 'liter',
                'harga_beli' => 28000,
                'harga_jual' => 32000,

            ],
            [

                'nama_item' => 'Teh Celup ',
                'uom' => 'box',
                'harga_beli' => 7500,
                'harga_jual' => 8500,

            ],
            [

                'nama_item' => 'Sabun Mandi',
                'uom' => 'batang',

                'harga_beli' => 3500,
                'harga_jual' => 4500,

            ],
        ];

        foreach ($items as $data) {
            Item::create($data);
        }
    }
}
