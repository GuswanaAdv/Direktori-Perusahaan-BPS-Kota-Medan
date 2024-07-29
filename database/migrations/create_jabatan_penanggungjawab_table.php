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
        Schema::create('jabatan_penanggungjawab', function (Blueprint $table) {
            $table->integer('kode_jabatan_penanggungjawab')->primary();
            $table->char('nama_jabatan_penanggungjawab', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jabatan_penanggungjawab');
    }
};
