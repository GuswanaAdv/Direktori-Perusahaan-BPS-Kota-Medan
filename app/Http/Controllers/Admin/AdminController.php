<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PegawaiImport;

class AdminController extends Controller
{
    public function tampil()
    {
        $pegawais = Pegawai::paginate(10);
        $message = $pegawais->isEmpty() ? 'tidak ditemukan' : '';

        return view('page-admin.beranda',[
            'judul' => 'Beranda',
            'pegawais' => $pegawais,
            'cari' => "-",
            'pesan' => $message,
        ]);
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

    public function search2(){
        $search = request('search');
        $pegawais = Pegawai::where('nama_pegawai', 'like', "%$search%")
                    ->orWhere('jenis_kelamin', 'like', "%$search%")
                    ->orWhere('usia', 'like', "%$search%")
                    ->orWhere('no_wa', 'like', "%$search%")
                    ->orWhere('alamat', 'like', "%$search%")
                    ->orWhere('nip', 'like', "%$search%")
                    ->paginate(5);
        $message = $pegawais->isEmpty() ? 'tidak ditemukan' : '';

        return view('page-admin.beranda',[
            'judul' => 'Beranda',
            'pegawais' => $pegawais,
            'cari' => $search,
            'pesan' => $message,
        ]);
    }

    public function tampilTambah()
    {
        return view('page-admin.pegawai-tambah',[
            'judul' => 'Petugas',
            'cari' => "-",
            'pesan' => "-",
        ]);
    }

    public function importExcel(Request $request)
	{
        try{
            // validasi
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx',
            ]);

            // menangkap file excel
            $file = $request->file('file');

            // membuat nama file unik
            $nama_file = rand().$file->getClientOriginalName();

            // upload ke folder file_siswa di dalam folder public
            $file->move('file_pegawai',$nama_file);

            // import data
            Excel::import(new PegawaiImport, public_path('/file_pegawai/'.$nama_file) );

            // alihkan halaman kembali
            return redirect()->route('beranda-admin')->with('pesanTambahPegawai','Data Berhasil Diimport');
        }
        catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            return redirect()->route('pegawai-tambah')->with('pesanTambahPegawai', 'Terjadi kesalahan saat mengimpor data: '.$e->getMessage());
        }
	}

    public function tampilProfil(){
        return view('page-admin.profil',[
            'judul' => 'Profil',
            'cari' => "-",
            'pesan' => "-",
        ]);
    }

    public function editProfil(Request $request){
        try{
            $this->validate($request, [
                'email' => 'required|email:dns',
            ]);

            $email = $request->input('email');

            $user = User::where('id_pengguna', Auth::user()->id_pengguna)->first();

            $user->update([
                'email' => $email,
            ]);

            return redirect()->route('profil-admin')->with('pesanEditProfil','Profil Berhasil Diubah');
        }catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            return redirect()->route('profil-admin')->with('pesanEditProfil', 'Terjadi kesalahan saat mengubah profil: '.$e->getMessage());
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
                return redirect()->route('profil-admin')->with('pesanGantiPassword','Berhasil Mengganti Password');
            }else{
                return redirect()->route('profil-admin')->with('pesanGantiPassword', 'Password lama salah');
            }

        }catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            return redirect()->route('profil-admin')->with('pesanGantiPassword', 'Terjadi kesalahan saat mengganti password: '.$e->getMessage());
        }
    }
}
