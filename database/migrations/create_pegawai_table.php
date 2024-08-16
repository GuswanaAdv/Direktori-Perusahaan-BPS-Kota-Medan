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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->char('nip', 18)->primary() ;
            $table->integer('id_pengguna')->constrained('users');
            $table->char('nama_pegawai', 50);
            $table->char('id_tim_kerja', 4)->constrained('tim_kerja');
            $table->char('id_jabatan', 4)->constrained('jabatan');
            $table->char('jenis_kelamin', 9);
            $table->char('usia', 2);
            $table->char('no_wa', 15);
            $table->char('alamat', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};
