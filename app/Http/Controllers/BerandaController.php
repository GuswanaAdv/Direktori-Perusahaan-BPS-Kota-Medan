<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\KegiatanStatistik;
use App\Models\Pengguna;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BerandaController extends Controller
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

        return view('page.beranda',[
            'judul' => 'Beranda',
            'kegiatanStatistiks' => $kegiatanStatistiks,
            'cari' => "-",
            'pesan' => $message,
        ]);
    }

    function tampil2($login)
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

        return view('page.beranda',[
            'judul' => 'Beranda',
            'kegiatanStatistiks' => $kegiatanStatistiks,
            'cari' => "-",
            'pesan' => $message,
            'login' => $login,
        ]);
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $pegawai = Pengguna::where('email', $email)->first();

        if($pegawai->isEmpty()){
            $login = 'Email tidak ditemukan';
        }elseif($pegawai->password != $password){
            $login = 'Password salah';
        }else{
            $login = 'Login berhasil';
            // tampil2($login);
        }
    }

    public function logout(){
        return view('layout.login');
    }
}
