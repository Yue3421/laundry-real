<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paket;

class PaketSeeder extends Seeder
{
    public function run(): void
    {
        Paket::create([
            'id_outlet' => 1,
            'jenis' => 'kiloan',
            'nama_paket' => 'Paket Kiloan Standar',
            'harga' => 5000,
        ]);

        Paket::create([
            'id_outlet' => 1,
            'jenis' => 'selimut',
            'nama_paket' => 'Paket Selimut Express',
            'harga' => 15000,
        ]);

        Paket::create([
            'id_outlet' => 1,
            'jenis' => 'bed_cover',
            'nama_paket' => 'Paket Bed Cover Premium',
            'harga' => 20000,
        ]);
    }
}