<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nama_lengkap',
        'alamat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relasi user dengan table dan model foto
    public function foto()
    {
        return $this->hasMany(Foto::class, 'users_id');
    }

    // Relasi user dengan table dan model like
    public function likefoto()
    {
        return $this->hasMany(Like::class, 'users_id');
    }

    // Relasi user dengan table dan model komentar
    public function komentarfoto()
    {
        return $this->hasMany(Komentar::class, 'users_id');
    }
}
