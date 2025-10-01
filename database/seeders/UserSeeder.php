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
            'nohp' => '081234567890',
            'role' => 'petugas',
            'image' => '1759207457_68db60213564a.jpg',
        ]);

        // Pengunjung 1
        User::create([
            'name' => 'yuki',
            'email' => 'pengunjung@example.com',
            'password' => Hash::make('password123'),
            'nohp' => '081234567890',
            'role' => 'pengunjung',
            'image' => '1759250074_68dc069a24e42.jpg',
        ]);

        // Pengunjung 2
        User::create([
            'name' => 'Lewd chan',
            'email' => 'hikarilight83@gmail.com',
            'password' => Hash::make('password123'),
            'nohp' => '081234567896',
            'role' => 'pengunjung',
            'image' => '1759250074_68dc069a24e42.jpg',
        ]);
    }
}
