<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\KegiatanStatistikController;
use App\Http\Controllers\PetugasController;
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
Route::get('/login', [BerandaController::class, 'tampilLogin'])->name('tampil-login')->middleware('guest');
Route::post('/login-process', [BerandaController::class, 'login'])->name('login');

//Harus login dulu
Route::group(['middleware' => ['auth', 'nocache']], function () {

    Route::get('/beranda', [BerandaController::class, 'tampil'])->name('beranda');
    Route::post('/logout', [BerandaController::class, 'logout'])->name('logout');

    Route::get('/perusahaan', [PerusahaanController::class, 'tampil'])->name('perusahaan');
    Route::get('/perusahaan/{id_sbr}', [PerusahaanController::class, 'lengkap'])->name('perusahaan-view');
    Route::post('/perusahaan_search', [PerusahaanController::class, 'search1'])->name('perusahaan-search1');
    Route::get('/perusahaan_search', [PerusahaanController::class, 'search2'])->name('perusahaan-search2');
    Route::get('/perusahaan_tambah', [PerusahaanController::class, 'tampilTambah'])->name('perusahaan-tambah');
    Route::post('/perusahaan_tambah_proses', [PerusahaanController::class, 'importExcel'])->name('perusahaan-tambah-proses');

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

