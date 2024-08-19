@extends('layout.pegawai')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">

            <div class="card-body w-full text-2xl text-left sm:px-20 border-b-2 font-bold">
                Silahkan input kegiatan statistik
            </div>

            @include('component.pesan')
            <div class="card-body w-full text-left sm:px-20">

                <form class="mx-auto w-full" action="{{ route('kegiatan-statistik-tambah-proses') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid sm:grid-cols-2 grid-cols-1">
                        <div>
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Kode Kegiatan</span>
                                </div>
                                <input type="text" placeholder="Kode Kegiatan" name="kode-kegiatan" class="input input-bordered w-full max-w-xs" value="{{ $kode_kegiatan }}" readonly required/>
                            </label>

                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Nama Kegiatan</span>
                                </div>
                                <input type="text" placeholder="Nama Kegiatan" name="nama-kegiatan" class="input input-bordered w-full max-w-xs" required/>
                            </label>

                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Waktu Mulai</span>
                                </div>
                                <input type="date" placeholder="Waktu Mulai" name="waktu-mulai"
                                class="input input-bordered w-full max-w-xs"
                                id="waktu-mulai" required/>
                            </label>

                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Waktu Selesai</span>
                                </div>
                                <input type="date" placeholder="Waktu Selesai" name="waktu-selesai"
                                class="input input-bordered w-full max-w-xs"
                                id="waktu-selesai" required/>
                            </label>
                        </div>

                        <div>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Keterangan</span>
                                </div>
                                <textarea class="textarea textarea-bordered h-52 textarea-md"
                                    placeholder="Keterangan Kegiatan Statistik"
                                    name="keterangan" required></textarea>
                            </label>
                            <div class="flex justify-end w-full">
                                <button class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey mt-8"
                                type="submit">
                                    Tambah
                                </button>
                            </div>
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
