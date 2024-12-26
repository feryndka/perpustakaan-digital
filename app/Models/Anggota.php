<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Import the HasFactory trait
use Illuminate\Database\Eloquent\Model;


class Anggota extends Authenticatable
{
    use HasFactory;

    protected $table = 'anggota';
    protected $fillable = [
        'nama',
        'alamat',
        'noHP',
        'username',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function dataPeminjaman()
    {
        return $this->hasMany(Data_Peminjaman::class, 'idAnggota');
    }
}
