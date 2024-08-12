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
        Schema::create('petugas', function (Blueprint $table) {
            $table->char('id_petugas',5)->primary();
            $table->integer('id_pengguna')->constrained('users');
            $table->char('nama_petugas',50);
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
        Schema::dropIfExists('petugas');
    }
};
