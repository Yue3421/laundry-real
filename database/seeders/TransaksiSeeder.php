<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        Transaksi::create([
            'id_outlet' => 1,
            'kode_invoice' => 'INV-001',
            'id_member' => 1,
            'tgl' => Carbon::now(),
            'batas_waktu' => Carbon::now()->addDays(3),
            'tgl_bayar' => null,
            'biaya_tambahan' => 0,
            'diskon' => 0.0,
            'pajak' => 0,
            'status' => 'baru',
            'dibayar' => 'belum_dibayar',
            'id_user' => 1, // Admin
        ]);

        Transaksi::create([
            'id_outlet' => 1,
            'kode_invoice' => 'INV-002',
            'id_member' => 2,
            'tgl' => Carbon::now()->subDay(),
            'batas_waktu' => Carbon::now()->addDays(2),
            'tgl_bayar' => Carbon::now(),
            'biaya_tambahan' => 2000,
            'diskon' => 10.0,
            'pajak' => 500,
            'status' => 'proses',
            'dibayar' => 'dibayar',
            'id_user' => 2, // Kasir
        ]);
    }
}