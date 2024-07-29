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
            // Blok 1
            $table->char('id_brs',10)->primmary();
            $table->char('nama_usaha',50);
            $table->char('nama_komersial',50);
            $table->integer('kode_unit_statistik')->constrained('unit_statistik');
            $table->char('provinsi');
            $table->char('kabupaten');
            $table->char('kecamatan');
            $table->char('kelurahan');
            $table->char('nama_sls',100);
            $table->char('alamat_sbr',100);
            $table->char('alamat_pencacahan',100);
            $table->char('kode_pos',5);
            $table->char('telepon',15);
            $table->char('email',50);
            $table->char('website',50);
            $table->integer('id_kondisi_perusahaan')->constrained('kondisi_perusahaan');
            $table->char('lattitude',20);
            $table->char('longitude',20);

            // Blok 2
            $table->char('kegiatan_utama',200);
            $table->char('kode_kbli',10)->constrained('kbli');
            $table->char('produk_utama',200);
            $table->char('kode_kbki',10)->constrained('kbki');
            $table->integer('kode_jenis_kepemilikan')->constrained('jenis_kepemilikan');
            $table->integer('kode_bentuk_badan_usaha')->constrained('bentuk_badan_usaha');
            $table->integer('kode_laporan_keuangan')->constrained('laporan_keuangan');
            $table->char('tahun_berdiri',4);
            $table->char('tahun_mulai_beroperasi',4);
            $table->char('no_induk_berusaha',20)->nullable();
            $table->integer('kode_skala_usaha')->constrained('skala_usaha');
            $table->integer('kode_jaringan_usaha')->constrained('jaringan_usaha');
            $table->integer('kode_preferensi_lokasi_pencacahan')->constrained('preferensi_lokasi_pencacahan')->nullable();
            $table->char('nama_kantor_pusat',50)->nullable();
            $table->char('alamat_kantor_pusat',100)->nullable();
            $table->char('email_kantor_pusat',50)->nullable();
            $table->char('negara_kantor_pusat',15)->nullable();
            $table->char('provinsi_kantor_pusat',30)->nullable();
            $table->char('kabupaten_kantor_pusat',30)->nullable();
            $table->char('kecamatan_kantor_pusat',30)->nullable();

            // Blok 3
            $table->char('nama_penanggungjawab',30);
            $table->char('jenis_kelamin_penanggungjawab',10);
            $table->char('tanggal_lahir_penanggungjawab',12);
            $table->char('kewarganegaraan_penanggungjawab',20);
            $table->integer('kode_jabatan_penanggungjawab')->constrained('jabatan_penanggungjawab');
            $table->char('nama_pemegang_saham',100)->nullable();
            $table->char('negara_pemegang_saham',15);
            $table->char('npwp_perusahaan',30);
            $table->integer('kode_status_penanaman_modal')->constrained('status_penanaman_modal');
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
