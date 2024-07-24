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
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->char('kode_brs',10)->primmary();
            $table->char('kode_perusahaan',5);
            $table->char('nama_perusahaan',50);
            $table->char('pemilik_perusahaan',50);
            $table->char('kategori_perusahaan',30);
            $table->char('status_perusahaan',20);
            $table->char('keterangan',200);
            $table->char('kode_klasifikasi',10)->constrained('kbli');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perusahaan');
    }
};
