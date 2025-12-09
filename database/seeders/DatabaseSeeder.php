<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(OutletSeeder::class);
        $this->call(MemberSeeder::class); // Baru
        $this->call(UserSeeder::class);
        $this->call(PaketSeeder::class); // Baru
        $this->call(TransaksiSeeder::class); // Baru
        $this->call(DetailTransaksiSeeder::class); // Baru
    }
}