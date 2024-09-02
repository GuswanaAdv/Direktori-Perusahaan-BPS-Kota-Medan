<?php

namespace App\Http\Controllers\Pegawai;
use Carbon\Carbon;
use App\Models\KegiatanStatistik;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\KondisiPerusahaan;

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

        $kondisiPerusahaan = KondisiPerusahaan::all();
        $ringkasan = array();
        $test1 = array();
        $test1['status'] = 'Belum Diberikan Kode Kondisi';
        $test1['jumlah'] = Perusahaan::where('kode_kondisi_perusahaan', 10)->orWhere('kode_kondisi_perusahaan', '-')->get()->count();
        array_push($ringkasan,$test1);
        foreach($kondisiPerusahaan as $kondisi){
            $test = array();
            $test['status'] = $kondisi->nama_kondisi_perusahaan;
            $test['jumlah'] = Perusahaan::where('kode_kondisi_perusahaan', $kondisi->kode_kondisi_perusahaan)->get()->count();
            array_push($ringkasan,$test);
        }
        $test1['status'] = 'Total';
        $test1['jumlah'] = Perusahaan::all()->count();
        array_push($ringkasan,$test1);

        return view('page-pegawai.beranda',[
            'judul' => 'Beranda',
            'kegiatanStatistiks' => $kegiatanStatistiks,
            'cari' => "-",
            'pesan' => $message,
            'ringkasan' => $ringkasan,
        ]);
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
            return redirect()->route('profil')->with('pesanEditProfil', 'Terjadi kesalahan saat mengubah profil: '.$result);
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
            return redirect()->route('profil')->with('pesanGantiPassword', 'Terjadi kesalahan saat mengganti password: '.$result);
        }
    }
}
