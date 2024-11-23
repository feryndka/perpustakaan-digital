<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('anggota')->insert([
	[
            'nama' => 'Fery Andika',
            'alamat' => 'Jakarta Timur',
            'noHP' => "124017024709",
            'username' => 'feryndka',
            'password' => bcrypt('fery123'),
            'role' => 'admin',
        ]);

        Anggota::create([
            'nama' => 'Zefanya Wahyu Sutejo',
            'alamat' => 'Jakarta Selatan',
            'noHP' => "12489712947",
            'username' => 'zefanyaws',
            'password' => bcrypt('zefanya123'),
            'role' => 'admin',
        ]);

        Anggota::create([
            'nama' => 'Gilang Abelard Fikhar',
            'alamat' => 'Bogor',
            'noHP' => "970325017390",
            'username' => 'gilang_abelard12',
            'password' => bcrypt('gilang123'),
            'role' => 'user',
        ]);

        Anggota::create([
            'nama' => 'Muhammad Iqbal Arrasyid',
            'alamat' => 'Buah Batu, Bandung',
            'noHP' => "927490719012",
            'username' => 'arrsyst',
            'password' => bcrypt('iqbal123'),
            'role' => 'user',
        ]);

        Anggota::create([
            'nama' => 'Muhammad Farid',
            'alamat' => 'Bandung',
            'noHP' => "6689251892674",
            'username' => 'muhmmdfrd_',
            'password' => bcrypt('farid123'),
            'role' => 'user',
        ]);

        Anggota::create([
            'nama' => 'Farah Annisa',
            'alamat' => 'Karawang',
            'noHP' => "124102707024",
            'username' => 'farahnisa',
            'password' => bcrypt('farah123'),
            'role' => 'user',
        ]);

        Anggota::create([
            'nama' => 'Safana Putri Salsabilla',
            'alamat' => 'Jakarta selatan',
            'noHP' => "124124819022",
            'username' => 'safanas',
            'password' => bcrypt('safana123'),
            'role' => 'user',
        ]);

        Anggota::create([
            'nama' => 'Naufal Gholib Shiddiq',
            'alamat' => 'Bandung',
            'noHP' => "914012740710",
            'username' => 'naufalgholibb',
            'password' => bcrypt('naufal123'),
            'role' => 'user',
        ]);
    }
}
