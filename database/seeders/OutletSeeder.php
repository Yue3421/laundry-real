<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Outlet;

class OutletSeeder extends Seeder
{
    public function run(): void
    {
        Outlet::create([
            'nama' => 'Outlet Utama',
            'alamat' => 'Jl. Contoh No. 123, Kota',
            'tlp' => '081234567890',
        ]);
    }
}