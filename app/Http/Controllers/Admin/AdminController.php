<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\TimKerja;
use App\Models\Jabatan;
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
        $timKerjas = Timkerja::all();
        $jabatans = Jabatan::all();
        return view('page-admin.pegawai-tambah',[
            'judul' => 'Petugas',
            'cari' => "-",
            'pesan' => "-",
            'timKerjas' => $timKerjas,
            'jabatans' => $jabatans,
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
            unlink(public_path('/file_pegawai/' . $nama_file));
            // alihkan halaman kembali
            return redirect()->route('beranda-admin')->with('pesanTambahPegawai','Data Berhasil Diimport');
        }
        catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            $message = $e->getMessage();
            $messageArray = explode(' ', $message);

            // Jika panjang pesan kurang dari atau sama dengan 30 karakter, gunakan pesan tersebut
            if (count($messageArray) < 11) {
                $result = $message;
            } else {
                // Ambil 11 elemen pertama
                $first11Elements = array_slice($messageArray, 0, 11);

                // Gabungkan elemen-elemen tersebut menjadi string
                $result = implode(' ', $first11Elements);
            }
            return redirect()->route('pegawai-tambah')->with('pesanTambahPegawai', 'Terjadi kesalahan saat mengimpor data: '.$result);
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
            $message = $e->getMessage();
            $messageArray = explode(' ', $message);

            // Jika panjang pesan kurang dari atau sama dengan 30 karakter, gunakan pesan tersebut
            if (count($messageArray) < 11) {
                $result = $message;
            } else {
                // Ambil 11 elemen pertama
                $first11Elements = array_slice($messageArray, 0, 11);

                // Gabungkan elemen-elemen tersebut menjadi string
                $result = implode(' ', $first11Elements);
            }
            return redirect()->route('profil-admin')->with('pesanEditProfil', 'Terjadi kesalahan saat mengubah profil: '.$result);
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
            $message = $e->getMessage();
            $messageArray = explode(' ', $message);

            // Jika panjang pesan kurang dari atau sama dengan 30 karakter, gunakan pesan tersebut
            if (count($messageArray) < 11) {
                $result = $message;
            } else {
                // Ambil 11 elemen pertama
                $first11Elements = array_slice($messageArray, 0, 11);

                // Gabungkan elemen-elemen tersebut menjadi string
                $result = implode(' ', $first11Elements);
            }
            return redirect()->route('profil-admin')->with('pesanGantiPassword', 'Terjadi kesalahan saat mengganti password: '.$result);
        }
    }

    public function resetPassword($nip){
        try{
            $pegawai = Pegawai::find($nip);
            $user = User::where('id_pengguna', $pegawai->user->id_pengguna)->first();
            $user->update([
                'password' => bcrypt('password'),
            ]);
            return redirect()->route('beranda-admin')->with('pesanGantiPassword','Berhasil Mereset Password');

        }catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            $message = $e->getMessage();
            $messageArray = explode(' ', $message);

            // Jika panjang pesan kurang dari atau sama dengan 30 karakter, gunakan pesan tersebut
            if (count($messageArray) < 11) {
                $result = $message;
            } else {
                // Ambil 11 elemen pertama
                $first11Elements = array_slice($messageArray, 0, 11);

                // Gabungkan elemen-elemen tersebut menjadi string
                $result = implode(' ', $first11Elements);
            }
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            return redirect()->route('beranda-admin')->with('pesanGantiPassword', 'Terjadi kesalahan saat mengganti password: '.$result);
        }
    }
}
