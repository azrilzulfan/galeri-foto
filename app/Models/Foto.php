<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'foto';

    protected $primaryKey = 'id';

    // Data yang bisa diisi
    protected $fillable = [
        'judul_foto',
        'deskripsi_foto',
        'tanggal_unggah',
        'lokasi_file',
        'album_id',
        'users_id',
    ];

    // Relasi foto dengan table dan model album
    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }

    // Relasi foto dengan table dan model user
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    // Relasi foto dengan table dan model like
    public function likefoto()
    {
        return $this->hasMany(Like::class, 'foto_id');
    }

    // Relasi foto dengan table dan model komentar
    public function komentarfoto()
    {
        return $this->hasMany(Komentar::class, 'foto_id');
    }

    // Mengecek apakah user memiliki like pada foto
    public function hasLike($user)
    {
        return $this->likefoto->contains('users_id', $user);
    }
}
