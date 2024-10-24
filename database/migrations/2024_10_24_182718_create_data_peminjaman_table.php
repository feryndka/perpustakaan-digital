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
            $table->id('idPermohonan');
	    $table->unsignedBigInteger('idAnggota');

	    // Defining the foreign key constraint
            $table->foreign('idAnggota')->references('idAnggota')->on('anggota')
                  ->onDelete('cascade'); // Optionally specify delete behavior

	    $table->unsignedBigInteger('idBuku');

	    // Defining the foreign key constraint
            $table->foreign('idBuku')->references('idBuku')->on('buku')
                  ->onDelete('cascade'); // Optionally specify delete behavior

	    $table->timestamps();
	    $table->integer('bulan');
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
