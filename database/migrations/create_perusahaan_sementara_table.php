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
        Schema::create('perusahaan_sementara', function (Blueprint $table) {
            // Blok 1
            $table->bigIncrements('id');
            $table->char('id_perusahaan',20);
            $table->enum('ada_sbr', ['ada','tidak ada'])->default('tidak ada'); //Tambahan Baris Baru
            $table->char('id_sbr',10);
            $table->char('tanggal_cacah_pertama',10);
            $table->char('tanggal_cacah_terakhir',10);
            $table->char('nama_usaha',100);
            $table->char('nama_komersial',100);
            // $table->char('id_petugas',18)->constrained('petugas');
            $table->char('nip',18)->constrained('pegawai');
            $table->char('nama_petugas',50)->default('belum ada');
            $table->integer('id_pembaruan')->constrained('pembaruan');
            $table->char('kode_kegiatan',18)->constrained('kegiatan_statistik');
            $table->integer('kode_unit_statistik')->constrained('unit_statistik');
            $table->char('provinsi');
            $table->char('kabupaten');
            $table->char('kecamatan');
            $table->char('kelurahan');
            $table->char('nama_sls',200)->nullable();
            $table->char('alamat_sbr',200);
            $table->char('alamat_pencacahan',200)->nullable();
            $table->char('kode_pos',5)->nullable();
            $table->char('telepon',15);
            $table->char('email',50)->nullable();
            $table->char('website',100)->nullable();
            $table->integer('kode_kondisi_perusahaan')->constrained('kondisi_perusahaan');
            $table->char('lattitude',20)->nullable();
            $table->char('longitude',20)->nullable();

            // Blok 2
            // $table->char('kegiatan_utama',200); //Dihilangkan
            $table->char('kode_kategori',2)->constrained('kategori_usaha')->default('-'); //Tambahan Tabel Baru
            $table->char('kode_kbli',10)->constrained('kbli')->nullable();
            $table->char('produk_utama',200)->nullable();
            $table->char('kode_kbki',10)->nullable();
            $table->integer('kode_jenis_kepemilikan')->constrained('jenis_kepemilikan')->nullable();
            $table->integer('kode_bentuk_badan_usaha')->constrained('bentuk_badan_usaha')->nullable();
            $table->integer('kode_laporan_keuangan')->constrained('laporan_keuangan')->nullable();
            $table->char('tahun_berdiri',4)->nullable();
            $table->char('tahun_mulai_beroperasi',4)->nullable();
            $table->char('no_induk_berusaha',20)->nullable();
            $table->integer('kode_skala_usaha')->constrained('skala_usaha')->nullable();
            $table->integer('kode_jaringan_usaha')->constrained('jaringan_usaha')->nullable();
            $table->integer('kode_preferensi')->constrained('preferensi_lokasi_pencacahan')->nullable();
            $table->char('nama_kantor_pusat',100)->nullable();
            $table->char('alamat_kantor_pusat',200)->nullable();
            $table->char('email_kantor_pusat',50)->nullable();
            $table->char('negara_kantor_pusat',30)->nullable();
            $table->char('provinsi_kantor_pusat',30)->nullable();
            $table->char('kabupaten_kantor_pusat',30)->nullable();
            $table->char('kecamatan_kantor_pusat',30)->nullable();

            // Blok 3
            $table->char('nama_penanggungjawab',50)->nullable();
            $table->char('jenis_kelamin_penanggungjawab',10)->nullable();
            $table->char('tanggal_lahir_penanggungjawab',12)->nullable();
            $table->char('kewarganegaraan_penanggungjawab',20)->nullable();
            $table->integer('kode_jabatan_penanggungjawab')->constrained('jabatan_penanggungjawab')->nullable();
            $table->char('nama_pemegang_saham',100)->nullable();
            $table->char('npwp_perusahaan',30)->nullable();
            $table->integer('kode_status_penanaman_modal')->constrained('status_penanaman_modal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perusahaan_sementara');
    }
};
