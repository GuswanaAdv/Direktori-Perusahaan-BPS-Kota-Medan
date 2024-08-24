<?php

namespace App\Http\Controllers\Petugas;
use App\Models\KegiatanStatistik;
use App\Models\PerusahaanKegiatan;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class KegiatanStatistik2Controller extends Controller
{
    public function tampil()
    {
        // Mendapatkan bulan dan tahun saat ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $kegiatanStatistiks = KegiatanStatistik::latest('tanggal_mulai')->
        when($currentMonth, function ($query) use ($currentMonth) {
            return $query->whereMonth('tanggal_mulai', $currentMonth);
        })
        ->when($currentYear, function ($query) use ($currentYear) {
            return $query->whereYear('tanggal_mulai', $currentYear);
        })->paginate(4);

        return view('page-petugas.kegiatan-statistik',[
            'judul' => 'Kegiatan Statistik',
            'kegiatanStatistiks' => $kegiatanStatistiks,
            'cari' => "-",
            'pesan' => "-",
        ]);
    }

    public function lengkap($kode_kegiatan)
    {
        $kegiatanStatistik = KegiatanStatistik::where('kode_kegiatan', $kode_kegiatan)->first();
        $perusahaanKegiatans = PerusahaanKegiatan::with(['perusahaan','pegawai','petugas','kegiatanStatistik'])
        ->where('kode_kegiatan', $kode_kegiatan)->paginate(10);
        $message = $perusahaanKegiatans->isEmpty() ? 'tidak ditemukan' : '';

        return view('page-petugas.kegiatan-statistik-view',[
            'judul' => 'Kegiatan Statistik',
            'kegiatanStatistik' => $kegiatanStatistik,
            'perusahaanKegiatans' => $perusahaanKegiatans,
            'pesan' => $message,
        ]);
    }

    public function search2(){
        // Mendapatkan bulan dan tahun saat ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $search = request('search');
        $kegiatanStatistiks = KegiatanStatistik::latest('tanggal_mulai')
        ->where('nama_kegiatan', 'like', "%$search%")
        ->when($currentMonth, function ($query) use ($currentMonth) {
            return $query->whereMonth('tanggal_mulai', $currentMonth);
        })
        ->when($currentYear, function ($query) use ($currentYear) {
            return $query->whereYear('tanggal_mulai', $currentYear);
        })

        ->orWhere('reverse_mulai', 'like', "%$search%")
        ->when($currentMonth, function ($query) use ($currentMonth) {
            return $query->whereMonth('tanggal_mulai', $currentMonth);
        })
        ->when($currentYear, function ($query) use ($currentYear) {
            return $query->whereYear('tanggal_mulai', $currentYear);
        })

        ->orWhere('reverse_selesai', 'like', "%$search%")
        ->when($currentMonth, function ($query) use ($currentMonth) {
            return $query->whereMonth('tanggal_mulai', $currentMonth);
        })
        ->when($currentYear, function ($query) use ($currentYear) {
            return $query->whereYear('tanggal_mulai', $currentYear);
        })->paginate(4);

        $message = $kegiatanStatistiks->isEmpty() ? 'tidak ditemukan' : '';

        return view('page-petugas.kegiatan-statistik',[
            'judul' => 'Kegiatan Statistik',
            'kegiatanStatistiks' => $kegiatanStatistiks,
            'cari' => $search,
            'pesan' => $message,
        ]);
    }
}
