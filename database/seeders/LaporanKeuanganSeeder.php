<?php

namespace Database\Seeders;

use App\Models\LaporanKeuangan;
use Illuminate\Database\Seeder;

class LaporanKeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LaporanKeuangan::insert([
            [
                'kode_laporan_keuangan' => '1',
                'nama_laporan_keuangan' => 'Ya, sesuai PSAK',
            ],
            [
                'kode_laporan_keuangan' => '2',
                'nama_laporan_keuangan' => 'Ya, tidak sesuai PSAK',
            ],
            [
                'kode_laporan_keuangan' => '3',
                'nama_laporan_keuangan' => 'Tidak',
            ],
        ]);
    }
}
