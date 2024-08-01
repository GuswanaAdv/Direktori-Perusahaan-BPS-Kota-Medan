<?php

use App\Http\Controllers\PerusahaanController;
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

Route::get('/', function () {return view('page.beranda',[
    'judul' => 'Beranda'
]);})->name('beranda');

Route::get('/survei', function () {return view('page.survei',[
    'judul' => 'Survei'
]);})->name('survei');

Route::get('/perusahaan', [PerusahaanController::class, 'tampil'])->name('perusahaan');
Route::get('/perusahaan/{id_sbr}', [PerusahaanController::class, 'lengkap'])->name('perusahaan-view');
Route::post('/perusahaan_search', [PerusahaanController::class, 'search1'])->name('perusahaan-search1');
Route::get('/perusahaan_search', [PerusahaanController::class, 'search2'])->name('perusahaan-search2');

Route::get('/petugas', function () {return view('page.petugas',[
    'judul' => 'Petugas'
]);})->name('petugas');

Route::get('/login', function(){ return view('layout.login');})->name('login');