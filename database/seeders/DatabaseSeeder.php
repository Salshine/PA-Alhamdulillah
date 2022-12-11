<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Matkul;
use App\Models\Prodi;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Matkul::create([
            "id" => 1,
            "nama" => "Pemrograman Dasar"
        ]);
        Matkul::create([
            "id" => 2,
            "nama" => "Pemrograman Lanjut"
        ]);
        Matkul::create([
            "id" => 3,
            "nama" => "Algoritma dan Struktur data"
        ]);
        Matkul::create([
            "id" => 4,
            "nama" => "Sistem Basis data"
        ]);
        Matkul::create([
            "id" => 5,
            "nama" => "Jaringan Komputer dasar"
        ]);

        Prodi::create([
            "id" => 1,
            "nama" => "Teknik Informatika"
        ]);
        Prodi::create([
            "id" => 2,
            "nama" => "Sistem Informasi"
        ]);
        Prodi::create([
            "id" => 3,
            "nama" => "Teknik Komputer"
        ]);
        Prodi::create([
            "id" => 4,
            "nama" => "Teknologi Informasi"
        ]);
        Prodi::create([
            "id" => 5,
            "nama" => "Pendidikan Teknologi Informasi"
        ]);
    }
}
