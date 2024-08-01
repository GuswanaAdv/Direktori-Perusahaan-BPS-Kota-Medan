<?php

namespace Database\Seeders;

use App\Models\Perusahaan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(PeranSeeder::class);
        $this->call(PenggunaSeeder::class);
        $this->call(PegawaiSeeder::class);
        $this->call(PetugasSeeder::class);
        $this->call(KegiatanStatistikSeeder::class);
        $this->call(PerusahaanSeeder::class);
        $this->call(PerusahaanKegiatanSeeder::class);
        
        $this->call(KBLISeeder::class); 
        $this->call(UnitStatistikSeeder::class);
        $this->call(JabatanPenanggungjawabSeeder::class);
        $this->call(SkalaUsahaSeeder::class);
        $this->call(LaporanKeuanganSeeder::class);
        $this->call(JaringanUsahaSeeder::class);
        $this->call(KondisiPerusahaanSeeder::class);
        $this->call(JenisKepemilikanSeeder::class);
        $this->call(PreferensiLokasiPencacahanSeeder::class);
        $this->call(StatusPenanamanModalSeeder::class);
        $this->call(BentukBadanUsahaSeeder::class);
    }
}
