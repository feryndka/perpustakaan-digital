<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data_Peminjaman extends Model
{
    protected $guarded =[];
    protected $table = 'data_peminjaman';

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id'); // Changed to 'anggota_id'
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'idBuku'); // Assuming 'idBuku' is correct
    }
}
