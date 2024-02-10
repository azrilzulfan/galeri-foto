<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likefoto';

    // data yang bisa diisi
    protected $fillable = [
        'foto_id',
        'users_id',
        'tanggal_like',
    ];

    // Relasi like dengan table dan model foto
    public function foto()
    {
        return $this->belongsTo(Foto::class, 'foto_id', 'id');
    }

    // Relasi like dengan table dan model user
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
