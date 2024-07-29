<?php

namespace Database\Seeders;

use App\Models\KondisiPerusahaan;
use Illuminate\Database\Seeder;

class KondisiPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KondisiPerusahaan::insert([
            [
                'kode_kondisi_perusahaan' => '1',
                'nama_kondisi_perusahaan' => 'Aktif',
            ],
            [
                'kode_kondisi_perusahaan' => '2',
                'nama_kondisi_perusahaan' => 'Tutup sementara',
            ],
            [
                'kode_kondisi_perusahaan' => '3',
                'nama_kondisi_perusahaan' => 'Belum beroperasi',
            ],
            [
                'kode_kondisi_perusahaan' => '4',
                'nama_kondisi_perusahaan' => 'Tutup',
            ],
            [
                'kode_kondisi_perusahaan' => '5',
                'nama_kondisi_perusahaan' => 'Alih usaha',
            ],
            [
                'kode_kondisi_perusahaan' => '6',
                'nama_kondisi_perusahaan' => 'Tidak ditemukan',
            ],
            [
                'kode_kondisi_perusahaan' => '7',
                'nama_kondisi_perusahaan' => 'Aktif pindah',
            ],
            [
                'kode_kondisi_perusahaan' => '8',
                'nama_kondisi_perusahaan' => 'Aktif nonrespon',
            ],
            [
                'kode_kondisi_perusahaan' => '9',
                'nama_kondisi_perusahaan' => 'Ganda/Duplikat',
            ],
        ]);
    }
}
