<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_peminjaman', function (Blueprint $table) {
            // Menghapus kolom bulan jika ada
            $table->dropColumn('bulan');

            // Menambahkan kolom idPustakawan sebagai foreign key
            $table->unsignedBigInteger('idPustakawan')->after('idAnggota'); // Pilih di mana Anda ingin menempatkannya
            
            // Menyediakan foreign key constraint
            $table->foreign('idPustakawan')->references('id')->on('anggota')->onDelete('cascade');
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
            // Jika rollback, tambahkan kembali kolom bulan
            $table->integer('bulan')->after('idBuku'); // Tempatkan sesuai di mana sebenarnya kolom bulan berada
            
            // Menghapus foreign key dan kolom idPustakawan
            $table->dropForeign(['idPustakawan']);
            $table->dropColumn('idPustakawan');
        });
    }
};
