<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailTransaksi;

class DetailTransaksiSeeder extends Seeder
{
    public function run(): void
    {
        // Untuk transaksi INV-001
        DetailTransaksi::create([
            'id_transaksi' => 1,
            'id_paket' => 1,
            'qty' => 2.5,
            'keterangan' => 'Cuci kiloan biasa',
        ]);

        // Untuk transaksi INV-002
        DetailTransaksi::create([
            'id_transaksi' => 2,
            'id_paket' => 2,
            'qty' => 1.0,
            'keterangan' => 'Selimut tebal',
        ]);

        DetailTransaksi::create([
            'id_transaksi' => 2,
            'id_paket' => 3,
            'qty' => 1.0,
            'keterangan' => 'Bed cover king size',
        ]);
    }
}