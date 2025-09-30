<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_buku',
        'id_petugas',
        'judul',
        'penulis',
        'deskripsi',
        'thumb',
        'kategori',
        'date_created'
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'id_petugas', 'id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_buku');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'id_buku');
    }

        public function suka()
    {
        return $this->hasMany(Suka::class, 'id_buku');
    }

    public function getAverageRatingAttribute()
    {
        return $this->rating()->average('rating') ?? 0;
    }
    public function genre()
    {
        return $this->hasMany(Genre::class, 'id_buku');
    }
}
