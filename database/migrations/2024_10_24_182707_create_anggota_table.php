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
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // nama Anggota
            $table->string('alamat'); // alamat
            $table->integer('noHP'); // noHP
            $table->string('username')->unique(); //username
            $table->string('password'); // password login
            $table->string('role'); // role admin, peminjam, dll
            $table->string('otorisasi'); // khusus admin untuk otorisasi fungsi tertentu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
