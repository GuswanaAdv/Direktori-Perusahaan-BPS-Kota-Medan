<?php

namespace App\Http\Controllers\Petugas;

use App\Models\KegiatanStatistik;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Petugas2Controller extends Controller
{
    public function tampil()
    {
        // Mendapatkan bulan dan tahun saat ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $kegiatanStatistiks = KegiatanStatistik::orderBy('tanggal_mulai', 'desc')
        ->when($currentMonth, function ($query) use ($currentMonth) {
            return $query->whereMonth('tanggal_mulai', $currentMonth);
        })
        ->when($currentYear, function ($query) use ($currentYear) {
            return $query->whereYear('tanggal_mulai', $currentYear);
        })
        ->get();
        $message = $kegiatanStatistiks->isEmpty() ? 'tidak ditemukan' : '';

        // dd($kegiatanStatistiks, $currentMonth, $currentYear);

        return view('page-petugas.beranda',[
            'judul' => 'Beranda',
            'kegiatanStatistiks' => $kegiatanStatistiks,
            'cari' => "-",
            'pesan' => $message,
        ]);
    }
}
