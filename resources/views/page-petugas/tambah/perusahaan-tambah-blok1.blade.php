@extends('layout.petugas')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">

            <div class="card-body w-full text-2xl text-center sm:px-20 border-b-2 font-bold">
                Form Tambah Perusahaan Baru
            </div>

            <div class="card-body w-full text-left sm:px-24 text-xl font-bold border-b-2">Blok 1</div>

            @include('component.pesan')
            <div class="card-body w-full text-left sm:px-20">

                <form class="mx-auto w-full" action="{{ route('perusahaan-tambah-blok1-proses') }}" method="POST"
                enctype="multipart/form-data" id="blok1-form">
                    @csrf
                    <div class="mb-8 pb-8 grid sm:grid-cols-2 grid-cols-1 sm:space-x-2 space-x-0 border-b-2">
                        @include('page-petugas.tambah.blok1.blok1-1')
                    </div>

                    <div class="mb-8 pb-8 grid sm:grid-cols-2 grid-cols-1 sm:space-x-2 space-x-0 border-b-2">
                        @include('page-petugas.tambah.blok1.blok1-2-kiri')
                        @include('page-petugas.tambah.blok1.blok1-2-kanan')
                    </div>

                    <div class="grid grid-cols-2 sm:space-x-2 space-x-0">
                        <div class="flex justify-end w-full max-w-xs">
                        </div>
                        <div class="flex justify-end w-full max-w-xs">
                            <button class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey mt-4"
                            type="submit">
                                Selanjutnya
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('blok1-form').addEventListener('submit', function(event) {
            // Ambil elemen select
            var kondisiPerusahaan = document.getElementById('kode-kondisi-perusahaan');
            var unitStatistik = document.getElementById('kode-unit-statistik');
            // Ambil nilai yang dipilih
            var selectedKondisiPerusahaan = kondisiPerusahaan.value;
            var selectedUnitStatistik = unitStatistik.value;

            // Ambil elemen peringatan
            var warningMessageKondisiPerusahaan = document.getElementById('warning-message-kode-kondisi-perusahaan');
            var warningMessageUnitStatistik = document.getElementById('warning-message-kode-unit-statistik');

            // Cek jika nilai yang dipilih adalah placeholder (kosong)
            if (selectedKondisiPerusahaan === "-") {
                // Tampilkan peringatan
                warningMessageKondisiPerusahaan.style.display = 'block';
                // Hentikan pengiriman form
                event.preventDefault();
            } else {
                // Sembunyikan peringatan jika nilai valid
                warningMessageKondisiPerusahaan.style.display = 'none';
            }

            // Cek jika nilai yang dipilih adalah placeholder (kosong)
            if (selectedUnitStatistik === "-") {
                // Tampilkan peringatan
                warningMessageUnitStatistik.style.display = 'block';
                // Hentikan pengiriman form
                event.preventDefault();
            } else {
                // Sembunyikan peringatan jika nilai valid
                warningMessageUnitStatistik.style.display = 'none';
            }
        });
    </script>
@endsection
