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

// Route::get('/', function () {return view('page.beranda',[
//     'judul' => 'Beranda'
// ]);})->name('beranda');
Route::get('/', [BerandaController::class, 'tampil'])->name('beranda');

Route::get('/perusahaan', [PerusahaanController::class, 'tampil'])->name('perusahaan');
Route::get('/perusahaan/{id_sbr}', [PerusahaanController::class, 'lengkap'])->name('perusahaan-view');
Route::post('/perusahaan_search', [PerusahaanController::class, 'search1'])->name('perusahaan-search1');
Route::get('/perusahaan_search', [PerusahaanController::class, 'search2'])->name('perusahaan-search2');

Route::get('/kegiatan-statistik', [KegiatanStatistikController::class, 'tampil'])->name('kegiatan-statistik');
Route::get('/kegiatan-statistik/{kode_kegiatan}', [KegiatanStatistikController::class, 'lengkap'])->name('kegiatan-statistik-view');
Route::get('/kegiatan-statistik_search', [KegiatanStatistikController::class, 'search2'])->name('kegiatan-statistik-search2');

Route::get('/petugas', [PetugasController::class, 'tampil'])->name('petugas');
Route::get('/petugas_search', [PetugasController::class, 'search2'])->name('petugas-search2');

Route::get('/login', function(){ return view('layout.login');})->name('login');