<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Data_Peminjaman;

class UpdatePeminjamanTerlambat extends Command
{
    protected $signature = 'peminjaman:update-terlambat';
    protected $description = 'Update status peminjaman terlambat';

    public function handle()
    {
        $lateBooks = Data_Peminjaman::where('batas_pengembalian', '<', now())
                                     ->where('status', '!=', 'Terlambat')
                                     ->update(['status' => 'Terlambat']);

        $this->info('Status buku terlambat sukses terupdate.');
    }
}