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
        Schema::create('perusahaan_survei', function (Blueprint $table) {
            $table->id('id_perusahaan_survei');
            $table->char('kode_survei',5)->constrained('survei');
            $table->char('id_brs',10)->constrained('perusahaan');
            $table->char('id_petugas',5)->consrainted('petugas');
            $table->char('hari_tanggal',20);
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
        Schema::dropIfExists('perusahaan_survei');
    }
};
