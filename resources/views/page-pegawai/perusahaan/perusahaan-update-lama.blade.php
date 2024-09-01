@extends('layout.pegawai')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">
            <div class="card-body w-full text-2xl text-center sm:px-20 border-b-2 font-bold">
                Update Data Perusahaan
            </div>

            @include('component.pesan')
            <div class="card-body w-full text-left sm:px-20">

                <form class="mx-auto py-4 space-y-2 w-full" action="{{ route('perusahaan-update-proses') }}"
                id="form-update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="w-full flex items-center justify-center">
                        <div class="grid grid-cols-1">
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

    @include('component.script-preview')
@endsection
