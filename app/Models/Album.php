<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'album';

    // Data yang bisa diisi
    protected $fillable = [
        'nama_album',
        'deskripsi',
        'tanggal_dibuat',
        'users_id'
    ];

    // Relasi album dengan table dan model user
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    // Relasi album dengan table dan model foto
    public function foto()
    {
        return $this->hasMany(Foto::class, 'album_id');
    }
}
