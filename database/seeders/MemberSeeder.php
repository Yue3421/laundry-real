<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        Member::create([
            'nama' => 'Pelanggan 1',
            'alamat' => 'Jl. Sudirman No. 10, Jakarta',
            'jenis_kelamin' => 'L',
            'tlp' => '081234567891',
        ]);

        Member::create([
            'nama' => 'Pelanggan 2',
            'alamat' => 'Jl. Thamrin No. 20, Jakarta',
            'jenis_kelamin' => 'P',
            'tlp' => '082345678912',
        ]);
    }
}