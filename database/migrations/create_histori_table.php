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
            $table->integer('id_perusahaan_survei')->constrained('perusahaan_survei');
            $table->char('kode_survei',5)->constrained('survei');
            $table->char('kode_brs',10)->constrained('perusahaan');
            $table->char('id_petugas',5)->consrainted('petugas');
            $table->char('nip',18)->constranted('pegawai');
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
        Schema::dropIfExists('histori');
    }
};
