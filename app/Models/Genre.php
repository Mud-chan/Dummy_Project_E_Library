<?php

// app\Models\Comment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genre';
    protected $primaryKey = 'id_genre';
    public $incrementing = false; // karena 'id' sudah string
    public $timestamps = false; // tidak menggunakan kolom timestamps

    protected $fillable = [
        'id_genre',
        'tag'
    ];

    public function detail_buku()
    {
        return $this->hasMany(Detail_buku::class, 'id_genre', 'id_genre');
    }
    public function bukus()
    {
        return $this->belongsToMany(
            Buku::class,
            'detail_buku',
            'id_genre',
            'id_buku'
        );
    }
}
