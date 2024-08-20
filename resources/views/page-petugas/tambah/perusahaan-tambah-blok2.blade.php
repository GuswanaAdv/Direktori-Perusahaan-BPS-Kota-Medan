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

                <form class="mx-auto w-full" action="{{ route('kegiatan-statistik-tambah-proses') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-8 pb-8 grid sm:grid-cols-2 grid-cols-1 sm:space-x-2 space-x-0 border-b-2">
                        @include('page-petugas.tambah.blok2.blok2-1-kiri')
                        @include('page-petugas.tambah.blok2.blok2-1-kanan')
                    </div>

                    <div class="grid grid-cols-2 sm:space-x-2 space-x-0">
                        <div class="flex justify-end w-full max-w-xs">
                            <a class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey mt-4"
                            href="#">
                                Sebelumnya
                            </a>
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
        // Fungsi untuk mendapatkan tanggal hari ini dalam format yyyy-mm-dd
        function getTodayDate() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0'); // Tambah 1 karena bulan dimulai dari 0
            const dd = String(today.getDate()).padStart(2, '0');
            return `${yyyy}-${mm}-${dd}`;
        }

        function getYesterdayDate(){
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0'); // Tambah 1 karena bulan dimulai dari 0
            const dd = String(today.getDate() + 1).padStart(2, '0');
            return `${yyyy}-${mm}-${dd}`;
        }

        // Mengisi input dengan nilai tanggal hari ini
        document.getElementById('waktu-mulai').value = getTodayDate();
        document.getElementById('waktu-selesai').value = getYesterdayDate();
    </script>
@endsection
