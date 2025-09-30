<?php

// app\Models\Comment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_buku extends Model
{
    protected $table = 'detail_buku';
    public $timestamps = false;
    protected $fillable = ['id_buku', 'id_genre'];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'id_genre');
    }
}
