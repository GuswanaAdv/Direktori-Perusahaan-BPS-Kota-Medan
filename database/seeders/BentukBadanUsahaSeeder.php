<?php

namespace Database\Seeders;

use App\Models\BentukBadanUsaha;
use Illuminate\Database\Seeder;

class BentukBadanUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BentukBadanUsaha::insert([
            [
                'kode_bentuk_badan_usaha' => '1',
                'nama_bentuk_badan_usaha' => 'Perseroan',
            ],
            [
                'kode_bentuk_badan_usaha' => '2',
                'nama_bentuk_badan_usaha' => 'Yayasan',
            ],
            [
                'kode_bentuk_badan_usaha' => '3',
                'nama_bentuk_badan_usaha' => 'Koperasi',
            ],
            [
                'kode_bentuk_badan_usaha' => '4',
                'nama_bentuk_badan_usaha' => 'Dana Pensiun',
            ],
            [
                'kode_bentuk_badan_usaha' => '5',
                'nama_bentuk_badan_usaha' => 'Perum/Perumda',
            ],
            [
                'kode_bentuk_badan_usaha' => '6',
                'nama_bentuk_badan_usaha' => 'BUM Desa',
            ],
            [
                'kode_bentuk_badan_usaha' => '7',
                'nama_bentuk_badan_usaha' => 'Persekutuan Komanditer (CV)',
            ],
            [
                'kode_bentuk_badan_usaha' => '8',
                'nama_bentuk_badan_usaha' => 'Persekutuan Firma',
            ],
            [
                'kode_bentuk_badan_usaha' => '9',
                'nama_bentuk_badan_usaha' => 'Persekutuan Perdata (Maatschap)',
            ],
            [
                'kode_bentuk_badan_usaha' => '10',
                'nama_bentuk_badan_usaha' => 'Kantor Perwakilan Luar Negeri',
            ],
            [
                'kode_bentuk_badan_usaha' => '11',
                'nama_bentuk_badan_usaha' => 'Badan Usaha Luar Negeri',
            ],
            [
                'kode_bentuk_badan_usaha' => '0',
                'nama_bentuk_badan_usaha' => 'Usaha Orang Perseorangan',
            ],
            [
                'kode_bentuk_badan_usaha' => '99',
                'nama_bentuk_badan_usaha' => 'Lainnya',
            ]
        ]);
    }
}
