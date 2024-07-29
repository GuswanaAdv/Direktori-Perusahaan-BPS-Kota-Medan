<?php

namespace Database\Seeders;

use App\Models\SkalaUsaha;
use Illuminate\Database\Seeder;

class SkalaUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SkalaUsaha::insert([
            [
                'kode_skala_usaha' => '1',
                'nama_skala_usaha' => 'Mikro',
            ],
            [
                'kode_skala_usaha' => '2',
                'nama_skala_usaha' => 'Kecil',
            ],
            [
                'kode_skala_usaha' => '3',
                'nama_skala_usaha' => 'Menengah',
            ],
            [
                'kode_skala_usaha' => '4',
                'nama_skala_usaha' => 'Besar',
            ],
        ]);
    }
}
