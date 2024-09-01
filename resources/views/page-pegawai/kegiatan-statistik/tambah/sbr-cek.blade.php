@extends('layout.pegawai')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">

            <div class="card-body w-full text-2xl text-left sm:px-20 border-b-2 font-bold">
                Silahkan masukkan sampel perusahaan dengan mengupload id sbr dalam format excel
            </div>
            <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
                <div role="alert" class="alert alert-info">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-6 w-6 shrink-0 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Catatan : Ikuti urutan format kolom berikut
                </div>
                <a class="btn bg-grey text-black hover:bg-orange hover:text-white"
                    href="{{ url('format-kolom/Format Kolom SBR.xlsx') }}"
                    id="download-link">
                    <img src="{{ url('logo/logo-download-4.png') }}" alt="download-image" class="sm:mx-2 sm:w-8 w-4">
                    Download Format Kolom SBR!!
                </a>
            </div>

            @include('component.pesan')
            <div class="card-body w-full text-left sm:px-20">

                <form class="mx-auto py-4 space-y-2 w-full" action="{{ route('proses-perusahaan-cek-sbr') }}"
                id="perusahaan-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="w-full flex items-center justify-center">
                        <div class="grid grid-cols-1">

                            <label class="block mb-2 text-sm font-bold text-black pl-2" for="user_avatar">
                                <input type="hidden" value="{{ Auth::user()->pegawai->nip }}" name="nip">
                                <input type="hidden" value="{{ $kode_kegiatan }}" name="kode-kegiatan">
                                Upload File Berekstensi .xlsx
                            </label>
                            <div class="w-full flex items-center justify-center">
                                <input type="file" name="file" id="fileInput"
                                    class="file-input file-input-success file-input-bordered w-full max-w-xs"
                                    accept=".xlsx" required/>
                            </div>
                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">
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

    @include('component.script-preview')
@endsection
