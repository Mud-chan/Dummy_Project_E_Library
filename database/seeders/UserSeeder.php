<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Petugas
        User::create([
            'name' => 'Admin Petugas',
            'email' => 'petugas@example.com',
            'password' => Hash::make('password123'),
            'nohp' => '083234567890',
            'role' => 'petugas',
        ]);

        // Pengunjung
        User::create([
            'name' => 'User Pengunjung',
            'email' => 'pengunjung@example.com',
            'password' => Hash::make('password123'),
            'nohp' => '081234567890',
            'role' => 'pengunjung',
        ]);
    }
}
