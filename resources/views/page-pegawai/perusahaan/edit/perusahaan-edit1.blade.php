@extends('layout.pegawai')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">

            <div class="card-body w-full text-2xl text-center sm:px-20 border-b-2 font-bold">
                Form Edit Perusahaan Baru
            </div>

            @include('component.pesan')
            <div class="card-body w-full text-left sm:px-20">

                <form class="mx-auto w-full" action="{{ route('perusahaan-edit1-proses') }}" method="POST"
                enctype="multipart/form-data" id="blok-form">
                    @csrf

                    <div class="mb-8 pb-8 border-b-2 text-xl font-bold pl-4">
                        Blok 1
                    </div>

                    <div class="mb-8 pb-8 grid sm:grid-cols-2 grid-cols-1 sm:space-x-2 space-x-0 border-b-2">
                        @include('page-pegawai.perusahaan.edit.blok1.blok1-1')
                    </div>

                    <div class="mb-8 pb-8 grid sm:grid-cols-2 grid-cols-1 sm:space-x-2 space-x-0 border-b-2">
                        @include('page-pegawai.perusahaan.edit.blok1.blok1-2-kiri')
                        @include('page-pegawai.perusahaan.edit.blok1.blok1-2-kanan')
                    </div>

                    <div class="mb-8 pb-8 border-b-2 text-xl font-bold pl-4">
                        Blok 2
                    </div>

                    <div class="mb-8 pb-8 grid sm:grid-cols-2 grid-cols-1 sm:space-x-2 space-x-0 border-b-2">
                        @include('page-pegawai.perusahaan.edit.blok2.blok2-1-kiri')
                        @include('page-pegawai.perusahaan.edit.blok2.blok2-1-kanan')
                    </div>

                    <div class="mb-8 pb-8 border-b-2 text-xl font-bold pl-4">
                        Blok 3
                    </div>

                    <div class="mb-8 pb-8 grid sm:grid-cols-2 grid-cols-1 sm:space-x-2 space-x-0 border-b-2">
                        @include('page-pegawai.perusahaan.edit.blok3.blok3-1-kiri')
                        @include('page-pegawai.perusahaan.edit.blok3.blok3-1-kanan')
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
@endsection
