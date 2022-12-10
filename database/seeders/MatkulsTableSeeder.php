<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatkulsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Matkul::create([
            'id' => [1, 2, 3, 4, 5],
            'matkul' => ['Pemrograman Dasar', 'Pemrograman Lanjut', 'Algoritma dan Struktur Data', 'Sistem Basis Data', 'Jaringan Komputer Dasar']
        ]);
        //
    }
}
