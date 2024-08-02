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
        Schema::create('kegiatan_statistik', function (Blueprint $table) {
            $table->char('kode_kegiatan',5)->primary();
            $table->char('nama_kegiatan',50);
            $table->char('tanggal_mulai',50);
            $table->char('tanggal_selesai',50);
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
        Schema::dropIfExists('kegiatan_statistik');
    }
};
