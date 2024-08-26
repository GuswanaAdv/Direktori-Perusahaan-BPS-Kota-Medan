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
        Schema::create('pembaruan', function (Blueprint $table) {
            $table->increments('id_pembaruan');
            $table->char('nip',18)->constrained('pegawai');
            $table->char('kode_kegiatan',20)->constrained('kegiatan_statistik');
            $table->enum('status', ['update', 'download'])->default('update');
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
        Schema::dropIfExists('pembaruan');
    }
};
