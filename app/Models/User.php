<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'nohp', 'role', 'image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


        public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_pengunjung', 'id');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class,'id_pengunjung', 'id');
    }

        public function suka()
    {
        return $this->hasMany(Suka::class, 'id_pengunjung', 'id');
    }

            public function bookmark()
    {
        return $this->hasMany(Bookmark::class, 'id_pengunjung', 'id');
    }
}
