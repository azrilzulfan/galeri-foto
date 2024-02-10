<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentarfoto';

    // data yang bisa diisi
    protected $fillable = [
        'foto_id',
        'users_id',
        'isi_komentar',
    ];

    // Relasi komentar dengan table dan model foto
    public function foto()
    {
        return $this->belongsTo(Foto::class, 'foto_id', 'id');
    }

    // Relasi komentar dengan table dan model user
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
