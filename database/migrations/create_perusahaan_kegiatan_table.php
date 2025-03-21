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
            $table->char('kode_kegiatan',18)->constrained('kegiatan_statistik');
            $table->char('id_perusahaan',20)->constrained('perusahaan');
            $table->char('id_petugas',5)->consrainted('petugas')->nullable();
            $table->char('nama_petugas',50);
            $table->char('nip',18)->constranted('pegawai');
            $table->char('status',100);
            $table->char('tanggal_kegiatan',20);
            $table->char('tanggal_penginputan',20);
            $table->char('reverse_kegiatan',20);
            $table->char('reverse_penginputan',20);
            $table->text('keterangan');
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
