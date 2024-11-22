<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDataPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_peminjaman', function (Blueprint $table) {
            // Menambahkan kolom baru
            $table->enum('status', ['Dipinjam', 'Kembali', 'Terlambat'])->default('Dipinjam')->after('idBuku');
            $table->date('tanggal_peminjaman')->after('status');
            $table->date('tanggal_kembali')->nullable()->after('tanggal_peminjaman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_peminjaman', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan jika migrasi di-rollback
            $table->dropColumn(['status', 'tanggal_peminjaman', 'tanggal_kembali']);
        });
    }
}
