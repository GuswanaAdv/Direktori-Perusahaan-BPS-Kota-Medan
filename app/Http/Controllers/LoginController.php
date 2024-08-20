<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
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

}
