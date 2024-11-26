<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    // Method to calculate late fee
    public function calculateLateFee()
    {
        $now = Carbon::now();

        // Check if batas_pengembalian is set and if it is before now
        if ($this->batas_pengembalian && $now->greaterThan($this->batas_pengembalian)) {
            // Calculate days late
            $daysLate = $now->diffInDays($this->batas_pengembalian);
            return $daysLate * 1000; // 1000 is the fee per day
        }

        return 0; // No late fee if not late
    }

}
