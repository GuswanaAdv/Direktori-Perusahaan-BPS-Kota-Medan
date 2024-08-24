<?php

use App\Http\Controllers\Pegawai\BerandaController;
use App\Http\Controllers\Pegawai\PerusahaanController;
use App\Http\Controllers\Pegawai\PerusahaanAprovalController;
use App\Http\Controllers\Pegawai\PerusahaanEditController;
use App\Http\Controllers\Pegawai\KegiatanStatistikController;
use App\Http\Controllers\Pegawai\PetugasController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Pegawai\PerusahaanUpdateController;
use App\Http\Controllers\Petugas\Petugas2Controller;
use App\Http\Controllers\Petugas\TambahPerusahaanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Pengarahan ketika menuju root
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('beranda'); // Sesuaikan dengan rute dashboard atau halaman yang diinginkan
    }
    return redirect()->route('tampil-login');
});

// Pengarahan ketika mencoba back setelah logout
Route::get('/login-process', function () {
    return redirect()->route('tampil-login');
});

//Sebelum login
Route::get('/tampil-login', [LoginController::class, 'tampilLogin'])->name('tampil-login')->middleware('guest');
Route::post('/login-process', [LoginController::class, 'login'])->name('login');

// Khusus download
Route::get('/perusahaan_aproval/cek/{id_pembaruan}', [PerusahaanAprovalController::class, 'downloadAproval'])->name('perusahaan-aproval-cek');
Route::post('/perusahaan_update_download', [PerusahaanUpdateController::class, 'download'])->name('perusahaan-update-download');

// Setelah login
Route::group(['middleware' => ['auth', 'nocache']], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Login sebagai pegawai
Route::group(['middleware' => ['auth', 'nocache','peran:p1']], function () {

    Route::get('/beranda', [BerandaController::class, 'tampil'])->name('beranda');
    Route::get('/profil', [BerandaController::class, 'tampilProfil'])->name('profil');
    Route::post('/edit-profil', [BerandaController::class, 'editProfil'])->name('edit-profil');
    Route::post('/ganti-password', [BerandaController::class, 'gantiPassword'])->name('ganti-password');

    Route::get('/perusahaan', [PerusahaanController::class, 'tampil'])->name('perusahaan');
    Route::get('/perusahaan/{id_perusahaan}', [PerusahaanController::class, 'lengkap'])->name('perusahaan-view');
    Route::post('/perusahaan_search', [PerusahaanController::class, 'search1'])->name('perusahaan-search1');
    Route::get('/perusahaan_search', [PerusahaanController::class, 'search2'])->name('perusahaan-search2');
    Route::get('/perusahaan_tambah', [PerusahaanController::class, 'tampilTambah'])->name('perusahaan-tambah');
    Route::post('/perusahaan_tambah_proses', [PerusahaanController::class, 'tambahPerusahaan'])->name('perusahaan-tambah-proses');

    Route::get('/perusahaan_aproval/ketuatim', [PerusahaanAprovalController::class, 'tampilAprovalKetuaTim'])->name('perusahaan-aproval-ketuatim');
    Route::get('/perusahaan_aproval/staff', [PerusahaanAprovalController::class, 'tampilAprovalStaff'])->name('perusahaan-aproval-staff');
    Route::get('/perusahaan_aproval/proses/{id_pembaruan}', [PerusahaanAprovalController::class, 'prosesAproval'])->name('perusahaan-aproval-proses');
    Route::get('/perusahaan_aproval/tolak/{id_pembaruan}', [PerusahaanAprovalController::class, 'tolakAproval'])->name('perusahaan-aproval-tolak');

    Route::get('perusahaan/edit/{id_perusahaan}', [PerusahaanEditController::class, 'tampilEdit1'])->name('perusahaan-edit1');
    Route::post('perusahaan/edit/proses', [PerusahaanEditController::class, 'prosesEdit1'])->name('perusahaan-edit1-proses');

    Route::get('/perusahaan_update', [PerusahaanUpdateController::class, 'tampilUpdate'])->name('perusahaan-update');
    Route::get('/perusahaan_update_search', [PerusahaanUpdateController::class, 'search1'])->name('perusahaan-update-search1');
    Route::post('/perusahaan_update_proses', [PerusahaanUpdateController::class, 'prosesUpdate'])->name('perusahaan-update-proses');

    Route::get('/kegiatan-statistik', [KegiatanStatistikController::class, 'tampil'])->name('kegiatan-statistik');
    Route::get('/kegiatan-statistik/{kode_kegiatan}', [KegiatanStatistikController::class, 'lengkap'])->name('kegiatan-statistik-view');
    Route::get('/kegiatan-statistik_search', [KegiatanStatistikController::class, 'search2'])->name('kegiatan-statistik-search2');
    Route::get('/kegiatan-statistik_tambah', [KegiatanStatistikController::class, 'tampilTambah'])->name('kegiatan-statistik-tambah');
    Route::post('/kegiatan-statistik_proses', [KegiatanStatistikController::class, 'prosesTambah'])->name('kegiatan-statistik-tambah-proses');

    Route::get('/petugas', [PetugasController::class, 'tampil'])->name('petugas');
    Route::get('/petugas_search', [PetugasController::class, 'search2'])->name('petugas-search2');
    Route::get('/petugas_tambah', [PetugasController::class, 'tampilTambah'])->name('petugas-tambah');
    Route::post('/petugas_tambah_proses', [PetugasController::class, 'importExcel'])->name('petugas-tambah-proses');
});

// Login sebagai admin
Route::group(['middleware' => ['auth', 'nocache','peran:p3']], function () {

    Route::get('/beranda/admin', [AdminController::class, 'tampil'])->name('beranda-admin');
    Route::get('/pegawai_search', [AdminController::class, 'search2'])->name('pegawai-search2');
    Route::get('/pegawai_tambah', [AdminController::class, 'tampilTambah'])->name('pegawai-tambah');
    Route::post('/pegawai_tambah_proses', [AdminController::class, 'importExcel'])->name('pegawai-tambah-proses');
    Route::get('/profil/admin', [AdminController::class, 'tampilProfil'])->name('profil-admin');
    Route::post('/edit-profil/admin', [AdminController::class, 'editProfil'])->name('edit-profil-admin');
    Route::post('/ganti-password/admin', [AdminController::class, 'gantiPassword'])->name('ganti-password-admin');
});

// Login sebagai petugas
Route::group(['middleware' => ['auth', 'nocache','peran:p2']], function () {

    Route::get('/beranda/petugas', [Petugas2Controller::class, 'tampil'])->name('beranda-petugas');
    Route::get('/perusahaan/petugas/{id_perusahaan}', [Petugas2Controller::class, 'lengkap'])->name('perusahaan-view-petugas');
    Route::get('/perusahaan_search/petugas', [Petugas2Controller::class, 'search2'])->name('perusahaan-search2-petugas');
    Route::get('/profil/petugas', [Petugas2Controller::class, 'tampilProfil'])->name('profil-petugas');
    Route::post('/edit-profil/petugas', [Petugas2Controller::class, 'editProfil'])->name('edit-profil-petugas');
    Route::post('/ganti-password/petugas', [Petugas2Controller::class, 'gantiPassword'])->name('ganti-password-petugas');

    Route::get('/perusahaan_tambah/blok1', [TambahPerusahaanController::class, 'tampilBlok1'])->name('perusahaan-tambah-blok1');
    Route::get('/perusahaan_tambah/blok2', [TambahPerusahaanController::class, 'tampilBlok2'])->name('perusahaan-tambah-blok2');
    Route::post('/perusahaan_tambah/blok1/proses', [TambahPerusahaanController::class, 'tambahBlok1'])->name('perusahaan-tambah-blok1-proses');
});
