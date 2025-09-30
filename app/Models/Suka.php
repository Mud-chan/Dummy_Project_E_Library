<?php

// app\Models\Comment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suka extends Model
{
    protected $table = 'suka';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_buku', 'id_pengunjung'
    ];

    public function user()
    {
    return $this->belongsTo(User::class, 'id_pengunjung');
    }
    public function buku()
    {
    return $this->belongsTo(Buku::class, 'id_buku');
    }
}

