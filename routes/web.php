<?php

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

Route::get('/perusahaan', function () {return view('page.perusahaan',[
    'judul' => 'Perusahaan'
]);})->name('perusahaan');

Route::get('/petugas', function () {return view('page.petugas',[
    'judul' => 'Petugas'
]);})->name('petugas');

Route::get('/login', function(){ return view('layout.login');})->name('login');