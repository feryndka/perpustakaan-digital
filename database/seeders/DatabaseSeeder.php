<?php

namespace Database\Seeders;

use App\Models\Anggota;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Anggota::create([
            'nama' => 'pustakawan',
            'alamat' => 'JL.kertanegara',
            'noHP' => 012345,
            'username' => 'adminlib',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        Anggota::create([
            'nama' => 'peminjam',
            'alamat' => 'JL.kembang',
            'noHP' => 123412,
            'username' => 'userlib',
            'password' => bcrypt('user123'),
            'role' => 'user',
        ]);
    }
}
