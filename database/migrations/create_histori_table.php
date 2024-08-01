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
        Schema::create('histori', function (Blueprint $table) {
            $table->id('id_histori');
            $table->integer('id_perusahaan_kegiatan')->constrained('perusahaan_kegiatan');
            $table->char('kode_kegiatan',5)->constrained('kegiatan_statistik');
            $table->char('id_sbr',10)->constrained('perusahaan');
            $table->char('id_petugas',5)->consrainted('petugas');
            $table->char('nip',18)->constranted('pegawai');
            $table->char('keterangan',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histori');
    }
};
