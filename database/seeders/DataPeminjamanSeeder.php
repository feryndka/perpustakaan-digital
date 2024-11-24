<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataPeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peminjamanData = [];

        // Menghasilkan 10 entri peminjaman untuk contoh
        for ($i = 0; $i < 10; $i++) {
            $idAnggota = rand(3, 8); // ID Anggota antara 3 dan 8
            $idPustakawan = rand(1, 2); // ID Pustakawan antara 1 dan 2
            $idBuku = rand(1, 5); // ID Buku antara 1 dan 5

            $tanggalPeminjaman = Carbon::create(2024, rand(1, 12), rand(1, 28)); // Menghasilkan tanggal acak

            // 50% kemungkinan tanggal_kembali null
            $tanggalKembali = (rand(0, 1) == 0) ? null : $tanggalPeminjaman->copy()->addWeek();

            // Menentukan status berdasarkan tanggal kembali
            $status = ($tanggalKembali == null) ? 'Dipinjam' : 'Kembali';


            // Menambahkan data ke array, sesuaikan dengan kolom migrasi
            $peminjamanData[] = [
                'idAnggota' => $idAnggota,
                'idPustakawan' => $idPustakawan,
                'idBuku' => $idBuku,
                'tanggal_peminjaman' => $tanggalPeminjaman,
                'tanggal_kembali' => $tanggalKembali,
                'status' => $status,
                'createdOn' => now(),
                'modifiedOn' => now(),
            ];
        }

        // Menginsert data ke tabel data_peminjaman
        DB::table('data_peminjaman')->insert($peminjamanData);
    }
}
