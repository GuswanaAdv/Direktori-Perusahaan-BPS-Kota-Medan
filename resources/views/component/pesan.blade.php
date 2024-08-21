@if (session()->has('loginError'))
    <div role="alert" class="alert alert-error">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 shrink-0 stroke-current"
        fill="none"
        viewBox="0 0 24 24">
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('loginError') }}</span>
    </div>

@elseif(session()->has('sessionExpired'))
    <div role="alert" class="alert alert-error">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 shrink-0 stroke-current"
        fill="none"
        viewBox="0 0 24 24">
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('sessionExpired') }}</span>
    </div>

@elseif(session()->has('pesan-petugas'))
    <div role="alert" class="alert alert-error">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 shrink-0 stroke-current"
        fill="none"
        viewBox="0 0 24 24">
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('pesan-petugas') }}</span>
    </div>

@elseif (session()->has('pesan-logout'))
    <div class="toast toast-top toast-center" id="myToast">
        <div class="alert bg-green text-white font-bold text-center">
            <span>{{ session('pesan-logout') }}</span>
        </div>
    </div>

@elseif (session()->has('pesanTambahPerusahaan'))
    @if (session('pesanTambahPerusahaan') == 'Data Berhasil Diimport')
        <div class="toast toast-top toast-center z-20" id="myToast">
            <div class="alert bg-green text-white font-bold text-center">
                <span>{{ session('pesanTambahPerusahaan') }}</span>
            </div>
        </div>
    @else
        <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
            <div role="alert" class="alert alert-error">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('pesanTambahPerusahaan') }}</span>
            </div>
        </div>
    @endif

@elseif (session()->has('pesanTambahPetugas'))
    @if (session('pesanTambahPetugas') == 'Data Berhasil Diimport')
        <div class="toast toast-top toast-center z-20" id="myToast">
            <div class="alert bg-green text-white font-bold text-center">
                <span>{{ session('pesanTambahPetugas') }}</span>
            </div>
        </div>
    @else
        <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
            <div role="alert" class="alert alert-error">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('pesanTambahPetugas') }}</span>
            </div>
        </div>
    @endif

@elseif (session()->has('pesanTambahPegawai'))
    @if (session('pesanTambahPegawai') == 'Data Berhasil Diimport')
        <div class="toast toast-top toast-center z-20" id="myToast">
            <div class="alert bg-green text-white font-bold text-center">
                <span>{{ session('pesanTambahPegawai') }}</span>
            </div>
        </div>
    @else
        <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
            <div role="alert" class="alert alert-error">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('pesanTambahPegawai') }}</span>
            </div>
        </div>
    @endif

@elseif (session()->has('pesanTambahKegiatanStatistik'))
    @if (session('pesanTambahKegiatanStatistik') == 'Kegiatan Statistik Berhasil Ditambahkan')
        <div class="toast toast-top toast-center z-20" id="myToast">
            <div class="alert bg-green text-white font-bold text-center">
                <span>{{ session('pesanTambahKegiatanStatistik') }}</span>
            </div>
        </div>
    @else
        <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
            <div role="alert" class="alert alert-error">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('pesanTambahKegiatanStatistik') }}</span>
            </div>
        </div>
    @endif

@elseif (session()->has('pesanEditProfil'))
    @if (session('pesanEditProfil') == 'Profil Berhasil Diubah')
        <div class="toast toast-top toast-center z-20" id="myToast">
            <div class="alert bg-green text-white font-bold text-center">
                <span>{{ session('pesanEditProfil') }}</span>
            </div>
        </div>
    @else
        <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
            <div role="alert" class="alert alert-error">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('pesanEditProfil') }}</span>
            </div>
        </div>
    @endif

@elseif (session()->has('pesanGantiPassword'))
    @if (session('pesanGantiPassword') == 'Berhasil Mengganti Password')
        <div class="toast toast-top toast-center z-20" id="myToast">
            <div class="alert bg-green text-white font-bold text-center">
                <span>{{ session('pesanGantiPassword') }}</span>
            </div>
        </div>
    @else
        <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
            <div role="alert" class="alert alert-error">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('pesanGantiPassword') }}</span>
            </div>
        </div>
    @endif

@elseif (session()->has('pesanBlok'))
    @if (session('pesanBlok') == 'berhasil menambahkan blok')
        <div class="toast toast-top toast-center z-20" id="myToast">
            <div class="alert bg-green text-white font-bold text-center">
                <span>{{ session('pesanBlok') }}</span>
            </div>
        </div>
    @else
        <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
            <div role="alert" class="alert alert-error">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('pesanBlok') }}</span>
            </div>
        </div>
    @endif

@elseif (session()->has('pesanAproval'))
    @if (session('pesanAproval') == 'Data berhasil di aproval')
        <div class="toast toast-top toast-center z-20" id="myToast">
            <div class="alert bg-green text-white font-bold text-center">
                <span>{{ session('pesanAproval') }}</span>
            </div>
        </div>
    @elseif(session('pesanAproval') == 'Data berhasil di tolak')
        <div class="toast toast-top toast-center z-20" id="myToast">
            <div class="alert bg-green text-white font-bold text-center">
                <span>{{ session('pesanAproval') }}</span>
            </div>
        </div>
    @else
        <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
            <div role="alert" class="alert alert-error">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('pesanAproval') }}</span>
            </div>
        </div>
    @endif

@elseif (session()->has('success'))
    <div class="toast toast-top toast-center" id="myToast">
        <div class="alert bg-green text-white font-bold text-center">
            <span>Login Berhasil!!</span>
        </div>
    </div>
@endif


<script>
    // Tunggu sampai halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Setelah 2 detik, sembunyikan elemen toast
        setTimeout(function() {
            document.getElementById('myToast').style.display = 'none';
        }, 2000); // 2000ms = 2 detik
    });
</script>
