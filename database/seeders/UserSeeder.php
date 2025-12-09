<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Admin Utama',
            'username' => 'admin',
            'password' => Hash::make('123456'),
            'id_outlet' => 1, // Sesuaikan kalau outlet id beda
            'role' => 'admin',
        ]);

        User::create([
            'nama' => 'Kasir 1',
            'username' => 'kasir',
            'password' => Hash::make('123456'),
            'id_outlet' => 1,
            'role' => 'kasir',
        ]);

        User::create([
            'nama' => 'Owner Bisnis',
            'username' => 'owner',
            'password' => Hash::make('123456'),
            'id_outlet' => 1,
            'role' => 'owner',
        ]);
    }
}