<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data_Peminjaman extends Model
{
    protected $guarded = [];
    protected $table = 'data_peminjaman';

    const CREATED_AT = 'createdOn'; // Ganti kolom created_at
    const UPDATED_AT = 'modifiedOn'; // Ganti kolom updated_at

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'idAnggota'); // Changed to 'idAnggota'
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'idBuku'); // Assuming 'idBuku' is correct
    }
}
