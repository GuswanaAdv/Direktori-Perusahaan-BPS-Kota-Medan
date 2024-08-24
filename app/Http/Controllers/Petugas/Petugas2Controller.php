<?php

namespace App\Http\Controllers\Petugas;

use App\Models\Perusahaan;
use App\Models\PerusahaanKegiatan;
use App\Models\User;
use App\Models\Petugas;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Petugas2Controller extends Controller
{
    public function tampil()
    {
        $perusahaans = Perusahaan::paginate(10);
        $message = $perusahaans->isEmpty() ? 'tidak ditemukan' : '';

        return view('page-petugas.beranda',[
            'judul' => 'Beranda',
            'perusahaans' => $perusahaans,
            'cari' => "-",
            'pesan' => $message,
        ]);
    }

    public function lengkap($id_perusahaan)
    {
        $perusahaan = Perusahaan::with(['jenisKepemilikan'])->where('id_perusahaan', $id_perusahaan)->first();
        $perusahaanKegiatans = PerusahaanKegiatan::with(['perusahaan','pegawai','petugas','kegiatanStatistik'])
        ->where('id_perusahaan', $id_perusahaan)->paginate(10);

        if ($perusahaan->lattitude != 0)
            $initialMarkers = [
                [
                    'position' => [
                        'lat' => $perusahaan->lattitude,
                        'lng' => $perusahaan->longitude
                    ],
                    'draggable' => true
                ],
            ];
        else
            $initialMarkers = 0;

        $message = $perusahaanKegiatans->isEmpty() ? 'tidak ditemukan' : '';
        $editor = PerusahaanKegiatan::where('nip', $perusahaan->nip)->when($id_perusahaan, function ($query) use ($id_perusahaan) {
            return $query->where('id_perusahaan', $id_perusahaan);
        })->latest('tanggal_penginputan')->first();

        return view('page-petugas.perusahaan-view',[
            'judul' => 'Beranda',
            'perusahaan' => $perusahaan,
            'perusahaanKegiatans' => $perusahaanKegiatans,
            'initialMarkers' => $initialMarkers,
            'pesan' => $message,
            'editor' => $editor,
        ]);
    }

    public function search2(){
        $search = request('search');
        $perusahaans = Perusahaan::where('nama_usaha', 'like', "%$search%")
                        ->orWhere('alamat_sbr','like',"%$search%")
                        ->paginate(10);
        $message = $perusahaans->isEmpty() ? 'tidak ditemukan' : '';

        return view('page-petugas.beranda',[
            'judul' => 'Beranda',
            'perusahaans' => $perusahaans,
            'cari' => $search,
            'pesan' => $message,
        ]);
    }

    public function tampilProfil(){
        return view('page-petugas.profil',[
            'judul' => 'Profil',
            'cari' => "-",
            'pesan' => "-",
        ]);
    }

    public function editProfil(Request $request){
        try{
            $this->validate($request, [
                'nama-petugas' => 'required',
                'id-petugas' => 'required',
                'email' => 'required|email:dns',
                'jenis-kelamin' => 'required',
                'usia' => 'required',
                'no-wa' => 'required',
            ]);

            $nama_petugas = $request->input('nama-petugas');
            $id_petugas = $request->input('id-petugas');
            $email = $request->input('email');
            $jenis_kelamin = $request->input('jenis-kelamin');
            $usia = $request->input('usia');
            $no_wa = $request->input('no-wa');

            $user = User::where('id_pengguna', Auth::user()->id_pengguna)->first();
            $petugas = Petugas::where('id_petugas', $id_petugas)->first();

            $user->update([
                'email' => $email,
            ]);

            $petugas->update([
                'nama_petugas' => $nama_petugas,
                'jenis_kelamin' => $jenis_kelamin,
                'usia' => $usia,
                'no_wa' => $no_wa,
            ]);

            return redirect()->route('profil-petugas')->with('pesanEditProfil','Profil Berhasil Diubah');
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
            return redirect()->route('profil-petugas')->with('pesanEditProfil', 'Terjadi kesalahan saat mengubah profil: '.$result);
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
                return redirect()->route('profil-petugas')->with('pesanGantiPassword','Berhasil Mengganti Password');
            }else{
                return redirect()->route('profil-petugas')->with('pesanGantiPassword', 'Password lama salah');
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
            return redirect()->route('profil-petugas')->with('pesanGantiPassword', 'Terjadi kesalahan saat mengganti password: '.$result);
        }
    }
}
