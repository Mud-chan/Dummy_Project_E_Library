<?php

// app\Models\Comment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    public $incrementing = false; // karena 'id' sudah string
    public $timestamps = false; // tidak menggunakan kolom timestamps

    protected $fillable = [
        'id_peminjaman', 'id_pengunjung', 'status', 'id_buku','tgl_pinjam','tgl_kembali'
    ];

    public function user()
    {
    return $this->belongsTo(User::class, 'id_pengunjung', 'id');
    }
    public function buku()
    {
    return $this->belongsTo(Buku::class, 'id_buku');
    }
}

