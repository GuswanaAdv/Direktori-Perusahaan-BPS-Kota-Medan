<?php

namespace App\Http\Controllers\Pegawai;
use Carbon\Carbon;
use App\Models\KegiatanStatistik;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

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
                }else if ($user->peran->nama_peran == 'Admin'){
                    $request->session()->regenerate();
                    return redirect()->route('beranda-admin')->with('success', 'Login berhasil!');
                }else if ($user->peran->nama_peran == 'Petugas'){
                    $request->session()->regenerate();
                    return redirect()->route('beranda-petugas')->with('success', 'Login berhasil!');
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

    public function tampilProfil(){
        return view('page-pegawai.profil',[
            'judul' => 'Profil',
            'cari' => "-",
            'pesan' => "-",
        ]);
    }

    public function editProfil(Request $request){
        try{
            $this->validate($request, [
                'nama-pegawai' => 'required',
                'nip' => 'required',
                'email' => 'required|email:dns',
                'jenis-kelamin' => 'required',
                'usia' => 'required',
                'no-wa' => 'required',
            ]);

            $nama_pegawai = $request->input('nama-pegawai');
            $nip = $request->input('nip');
            $email = $request->input('email');
            $jenis_kelamin = $request->input('jenis-kelamin');
            $usia = $request->input('usia');
            $no_wa = $request->input('no-wa');

            $user = User::where('id_pengguna', Auth::user()->id_pengguna)->first();
            $pegawai = Pegawai::where('nip', $nip)->first();

            $user->update([
                'email' => $email,
            ]);

            $pegawai->update([
                'nama_pegawai' => $nama_pegawai,
                'jenis_kelamin' => $jenis_kelamin,
                'usia' => $usia,
                'no_wa' => $no_wa,
            ]);

            return redirect()->route('profil')->with('pesanEditProfil','Profil Berhasil Diubah');
        }catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            return redirect()->route('profil')->with('pesanEditProfil', 'Terjadi kesalahan saat mengubah profil: '.$e->getMessage());
        }
    }

    public function gantiPassword(Request $request){
        try{
            $this->validate($request, [
                'password-lama' => 'required',
                'password-baru' => 'required',
                'konfirmasi-password-baru' => 'required|same:password-baru',
            ]);

            $user = User::where('id_pengguna', Auth::user()->id_pengguna)->first();
            $password_baru = $request->input('password-baru');
            $password_lama = $request->input('password-lama');
            if (Hash::check($password_lama, $user->password)){
                $user->update([
                    'password' => bcrypt($password_baru),
                ]);
                return redirect()->route('profil')->with('pesanGantiPassword','Berhasil Mengganti Password');
            }else{
                return redirect()->route('profil')->with('pesanGantiPassword', 'Password lama salah');
            }

        }catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            return redirect()->route('profil')->with('pesanGantiPassword', 'Terjadi kesalahan saat mengganti password: '.$e->getMessage());
        }
    }
}
