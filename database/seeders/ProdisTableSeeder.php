<?php

namespace Database\Seeders;

use App\Models\ProdisModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ProdisModel::create([
            'id' => [1, 2, 3, 4, 5],
            'prodi' => ['Teknologi Informasi', 'Sistem Informasi', 'Pendidikan Teknologi Informasi', 'Teknik Informatika', 'Teknik Komputer']
        ]);
        //
    }
}
