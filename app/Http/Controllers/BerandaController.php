<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\KegiatanStatistik;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        return view('page-pegawai.beranda',[
            'judul' => 'Beranda',
            'kegiatanStatistiks' => $kegiatanStatistiks,
            'cari' => "-",
            'pesan' => $message,
        ]);
    }

    public function login(Request $request){
        try {
            $request->validate([
                'email' => 'required|email:dns',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = User::with('peran')->find(Auth::id());
                // dd($user->peran->nama_peran);
                if ($user->peran->nama_peran == 'Pegawai'){
                    $request->session()->regenerate();
                    return redirect()->route('beranda')->with('success', 'Login berhasil!');
                }else{
                    Auth::logout();
                    Session::flush();
                    Session::regenerate();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->route('tampil-login')->with('pesan-petugas', 'Maaf, Fitur khusus petugas masih dalam pengembangan!!');
                }
            }

            return back()->with([
                'loginError' => "Login gagal!!",
            ]);

        } catch (\Illuminate\Session\TokenMismatchException $e) {
            return redirect()->route('tampil-login')->with(
                'sessionExpired','Sesi kamu telah berakhir, silahkan login kembali!!'
            );
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flush();
        Session::regenerate();
        return redirect()->route('tampil-login')->with([
            'pesan-logout' => 'Logout berhasil!!',
        ]);
    }

    public function tampilLogin()
    {
        return view('layout.login');
    }
}
