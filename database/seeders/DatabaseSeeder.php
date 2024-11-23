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
	$this->call([
            BukuSeeder::class,
	]);


	$this->call([
            DataPeminjamanSeeder::class,
	]);

	$this->call([
	   AnggotaSeeder::class,
	]);
    }
}
