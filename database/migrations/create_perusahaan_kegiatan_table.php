<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perusahaan_kegiatan', function (Blueprint $table) {
            $table->id('id_perusahaan_kegiatan');
            $table->char('kode_kegiatan',5)->constrained('kegiatan_statistik');
            $table->char('id_sbr',10)->constrained('perusahaan');
            $table->char('id_petugas',5)->consrainted('petugas');
            $table->char('nip',18)->constranted('pegawai');
            $table->char('aktivitas',20);
            $table->char('tanggal_kegiatan',20);
            $table->char('tanggal_penginputan',20);
            $table->char('keterangan',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perusahaan_kegiatan');
    }
};
