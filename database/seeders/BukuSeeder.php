<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        Buku::create([
            'id_buku' => 'buku_68dbeb8cb2f15',
            'id_petugas' => 1,
            'judul' => 'Mieruko Chan',
            'penulis' => 'Izumi, Tomoki (Story & Art)',
            'deskripsi' => 'Kisah horror dari gadis yang tau-tau bisa melihat ...',
            'thumb' => '1759243148_68dbeb8cb2f93.jpg',
            'kategori' => 'manga',
            'date_created' => '2025-09-30',
        ]);

        Buku::create([
            'id_buku' => 'buku_68dc0ec68e720',
            'id_petugas' => 1,
            'judul' => 'Nise Seijo Kuso of the Year: Risou no Seijo? Zanne...',
            'penulis' => 'kabedondaikou',
            'deskripsi' => '[The Eternal Scattering Flowers: Fiore Caduto Eter...',
            'thumb' => '1759252166_68dc0ec68e7c7.jpg',
            'kategori' => 'manga',
            'date_created' => '2025-09-30',
        ]);

        Buku::create([
            'id_buku' => 'buku_68dc10905bc3e',
            'id_petugas' => 1,
            'judul' => 'Shangri-La Frontier ~ Kusoge Hunter',
            'penulis' => 'KATA Rina',
            'deskripsi' => 'Adaptasi komik dari novel super populer dari syose...',
            'thumb' => '1759252624_68dc10905bcda.jpg',
            'kategori' => 'manga',
            'date_created' => '2025-09-30',
        ]);

        Buku::create([
            'id_buku' => 'buku_68dc1123b0c08',
            'id_petugas' => 1,
            'judul' => 'Revenge of the Iron-Blooded Sword Hound',
            'penulis' => 'I Stepped On Lego',
            'deskripsi' => 'Dia adalah anjing pemburu keluarga Baskerville: Vi...',
            'thumb' => '1759252771_68dc1123b0ce8.jpg',
            'kategori' => 'manhwa',
            'date_created' => '2025-09-30',
        ]);
    }
}
