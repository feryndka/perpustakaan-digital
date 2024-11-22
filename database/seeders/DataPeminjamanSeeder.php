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

            // Membuat tanggal acak pada tahun 2024
            $tanggalPeminjaman = Carbon::create(2024, rand(1, 12), rand(1, 28)); // Menghasilkan tanggal acak

            // Menambahkan data ke array
            $peminjamanData[] = [
                'idAnggota' => $idAnggota,
                'idPustakawan' => $idPustakawan,
                'idBuku' => $idBuku,
                'tanggal_peminjaman' => $tanggalPeminjaman->toDateString(),
                'tanggal_kembali' => $tanggalPeminjaman->copy()->addWeek()->toDateString(), // Menghitung tanggal kembali satu minggu kemudian
                'status' => 'Dipinjam',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Menginsert data ke tabel data_peminjaman
        DB::table('data_peminjaman')->insert($peminjamanData);
    }
}
