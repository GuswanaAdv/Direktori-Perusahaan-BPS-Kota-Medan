<?php

namespace Database\Seeders;

use App\Models\JaringanUsaha;
use Illuminate\Database\Seeder;

class JaringanUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JaringanUsaha::insert([
            [
                'kode_jaringan_usaha' => '1',
                'nama_jaringan_usaha' => 'Tunggal',
            ],
            [
                'kode_jaringan_usaha' => '2',
                'nama_jaringan_usaha' => 'Kantor Pusat',
            ],
            [
                'kode_jaringan_usaha' => '3',
                'nama_jaringan_usaha' => 'Kantor Cabang',
            ],
            [
                'kode_jaringan_usaha' => '4',
                'nama_jaringan_usaha' => 'Perwakilan',
            ],
            [
                'kode_jaringan_usaha' => '5',
                'nama_jaringan_usaha' => 'Pabrik/Unit Kegiatan',
            ],
            [
                'kode_jaringan_usaha' => '6',
                'nama_jaringan_usaha' => 'Unit Pembantu/Penunjang',
            ],
        ]);
    }
}
