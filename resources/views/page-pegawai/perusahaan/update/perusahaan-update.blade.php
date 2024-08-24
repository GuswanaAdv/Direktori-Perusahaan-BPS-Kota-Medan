@extends('layout.pegawai')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">

            <div class="card-body w-full text-2xl text-left sm:px-20 border-b-2 font-bold">
                <p class="pl-4 font-bold text-lg text-center">
                    Daftar Perusahaan yang Dipilih
                </p>
                <form action="{{ route('perusahaan-update-download') }}" method="post" id="form">
                    @csrf
                    <div class="w-full grid md:grid-cols-3 grid-cols-1 border-2 rounded-lg p-4 max-h-80 overflow-y-auto border border-darkgrey" id="kotak"></div>
                    <div id="warning-message-perusahaan" style="display: none;" class="text-center text-red text-sm">
                        Silahkan pilih perusahaan terlebih dahulu.
                    </div>
                    <button class="btn w-full mt-4 bg-grey text-black hover:bg-orange hover:text-whit">Download</button>
                </form>
            </div>
            <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
                @include('page-pegawai.perusahaan.update.download-tabel')
            </div>

            <div class="card-body w-full text-2xl text-center sm:px-20 border-b-2 font-bold">
                Update Data Perusahaan
            </div>

            @include('component.pesan')
            <div class="card-body w-full text-left sm:px-20">

                <form class="mx-auto py-4 space-y-2 w-full" action="{{ route('perusahaan-update-proses') }}"
                id="perusahaan-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="w-full flex items-center justify-center">
                        <div class="grid grid-cols-1">
                            <label class="form-control w-full mb-4">
                                <div class="label">
                                    <span class="label-text font-bold">Pilih kegiatan yang akan diikuti</span>
                                </div>
                                <select class="select select-bordered" name="kode-kegiatan" id="kode-kegiatan">
                                    <option value="-">Pilih Kegiatan</option>
                                    @foreach ($kegiatans as $kegiatan)
                                        <option value="{{ $kegiatan->kode_kegiatan }}">{{ $kegiatan->nama_kegiatan }}</option>
                                    @endforeach
                                </select>
                                <div id="warning-message" style="display: none; color: red; text-align: center;">
                                    Silakan pilih kegiatan terlebih dahulu.
                                </div>
                            </label>

                            <label class="block mb-2 text-sm font-bold text-black pl-2"
                                for="user_avatar">
                                <input type="hidden" value="{{ Auth::user()->pegawai->nip }}" name="nip">
                                Upload File Berekstensi .xlsx
                            </label>
                            <div class="w-full flex items-center justify-center">
                                <input type="file" name="file" id="fileInput"
                                    class="file-input file-input-success file-input-bordered w-full max-w-xs"
                                    accept=".xlsx" required/>
                            </div>
                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                            id="user_avatar_help">
                                pastikan urutan kolom excel sudah disusun dengan benar
                            </div>
                        </div>
                    </div>

                    <div id="preview" class="mt-4 w-full flex items-center justify-center"></div>

                    <div class="w-full flex items-center justify-center">
                       <button class="btn w-full max-w-xs bg-grey text-black hover:bg-orange hover:text-white"
                            type="submit">
                            UPLOAD
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @include('page-pegawai.perusahaan.perusahaan-script-preview')

    <script>
        document.getElementById('perusahaan-form').addEventListener('submit', function(event) {
            // Ambil elemen select
            var selectElement = document.getElementById('kode-kegiatan');
            // Ambil nilai yang dipilih
            var selectedValue = selectElement.value;

            // Ambil elemen peringatan
            var warningMessage = document.getElementById('warning-message');

            // Cek jika nilai yang dipilih adalah placeholder (kosong)
            if (selectedValue === "-") {
                // Tampilkan peringatan
                warningMessage.style.display = 'block';
                // Hentikan pengiriman form
                event.preventDefault();
            } else {
                // Sembunyikan peringatan jika nilai valid
                warningMessage.style.display = 'none';
            }
        });
    </script>
@endsection
