<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idAnggota');
            $table->unsignedBigInteger('idPustakawan')->nullable();
            $table->foreign('idAnggota')->references('id')->on('anggota')->onDelete('cascade');
            $table->foreign('idPustakawan')->references('id')->on('anggota')->onDelete('set null');
            $table->unsignedBigInteger('idBuku');
            $table->foreign('idBuku')->references('id')->on('buku')->onDelete('cascade');
            $table->enum('status', ['Persetujuan Peminjaman', 'Dipinjam', 'Persetujuan Pengembalian', 'Kembali', 'Terlambat'])->default('Dipinjam');
            $table->date('tanggal_peminjaman')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->timestamp('createdOn');
            $table->timestamp('modifiedOn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_peminjaman');
    }
};
