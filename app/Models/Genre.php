<?php

// app\Models\Comment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genre';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_buku', 'genre'
    ];
    public function buku()
    {
    return $this->belongsTo(Buku::class, 'id_buku');
    }
}

