<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_petugas',
        'judul',
        'penulis',
        'deskripsi',
        'thumb',
        'pdf',
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

    public function getAverageRatingAttribute()
    {
    return $this->rating()->average('rating') ?? 0;
    }
}
