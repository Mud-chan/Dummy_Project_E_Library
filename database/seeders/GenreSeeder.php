<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        Genre::create([
            'id_genre' => '1',
            'tag' => 'horror',
        ]);

        Genre::create([
            'id_genre' => '2',
            'tag' => 'supernatural',
        ]);

        Genre::create([
            'id_genre' => 'genre_3',
            'tag' => 'comedy',
        ]);

        Genre::create([
            'id_genre' => 'genre_4',
            'tag' => 'action',
        ]);
        Genre::create([
            'id_genre' => 'genre_5',
            'tag' => 'adventure',
        ]);
                Genre::create([
            'id_genre' => 'genre_5',
            'tag' => 'adventure',
        ]);
                Genre::create([
            'id_genre' => 'genre_6',
            'tag' => 'romance',
        ]);
                Genre::create([
            'id_genre' => 'genre_7',
            'tag' => 'drama',
        ]);
                Genre::create([
            'id_genre' => 'genre_8',
            'tag' => 'slice of life',
        ]);
                Genre::create([
            'id_genre' => 'genre_9',
            'tag' => 'fantasy',
        ]);
                Genre::create([
            'id_genre' => 'genre_10',
            'tag' => 'mystery',
        ]);
    }
}
