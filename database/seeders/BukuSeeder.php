<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buku')->insert([
            [
                'image' => asset('images/sang_pemimpi.jpg'), // URL gambar untuk Sang Pemimpi
                'judul' => 'Sang Pemimpi',
                'penulis' => 'Andrea Hirata',
                'lokasi' => '895.922',
                'jumlah' => 10,
                'deskripsi' => 'Sang Pemimpi adalah novel kedua dari Tetralogi Laskar Pelangi. Kisah ini melanjutkan perjalanan hidup tokoh-tokoh dari Laskar Pelangi yang menghadapi tantangan baru untuk mewujudkan mimpi mereka.',
                'tersedia' => true,
            ],
            [
                'image' => asset('images/laskar_pelangi.jpg'), // URL gambar untuk Laskar Pelangi
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'lokasi' => '895.922',
                'jumlah' => 12,
                'deskripsi' => 'Laskar Pelangi adalah sebuah novel yang mengisahkan tentang sekelompok anak-anak yang berjuang untuk mendapatkan pendidikan di Belitong. Novel ini menginspirasi banyak orang dengan nilai-nilai persahabatan dan perjuangan.',
                'tersedia' => true,
            ],
            [
                'image' => asset('images/hujan.jpg'), // URL gambar untuk Di Balik Cahaya
                'judul' => 'Hujan',
                'penulis' => 'Tere Liye',
                'lokasi' => '895.922',
                'jumlah' => 5,
                'deskripsi' => 'Tentang persahabatan. Tentang cinta. Tentang perpisahan. Tentang melupakan. Tentang hujan',
                'tersedia' => true,
            ],
            [
                'image' => asset('images/ketika_cinta_bertasbih.jpg'), // URL gambar untuk Ketika Cinta Bertasbih
                'judul' => 'Ketika Cinta Bertasbih',
                'penulis' => 'Habiburrahman El Shirazy',
                'lokasi' => '298.2',
                'jumlah' => 0,
                'deskripsi' => 'Novel ini berkisar pada dua tema besar, yaitu cinta dan agama, yang dibalut dalam kisah inspiratif seorang pemuda yang berjuang untuk cita-citanya tanpa meninggalkan nilai-nilai agama.',
                'tersedia' => false,
            ],
            [
                'image' => asset('images/perahu_kertas.jpg'), // URL gambar untuk Rumah yang Kehilangan
                'judul' => 'Perahu Kertas',
                'penulis' => 'Dee Lestari',
                'lokasi' => '895.922',
                'jumlah' => 7,
                'deskripsi' => 'Novel yang mengisahkan perjalanan cinta dan pencarian jati diri antara Kugy dan Gibran, memadukan mimpi dengan realita. Cerita ini menyiratkan pentingnya mengikuti kata hati dalam meraih impian dan menemukan tujuan hidup.',
                'tersedia' => true,
            ],
        ]);
    }
}
