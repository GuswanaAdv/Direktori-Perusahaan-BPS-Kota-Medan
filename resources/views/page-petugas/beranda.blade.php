@extends('layout.petugas')
@section('content')
    @include('component.searchbar.searchbar-petugas')
    @include('component.pesan')

    <div id="beranda" class="bg-white">
        <div class="flex items-center justify-center pt-4">
            <div class="flex sm:space-x-12 grid sm:grid-cols-2 grid-cols-1">
                <div class="flex items-center justify-center py-2">
                    <a class="btn border-darkgrey text-darkgrey bg-white hover:bg-darkgrey hover:text-white"
                    href="#">
                        <img src="{{ url('logo/logo-list-2.png') }}"
                            alt=""
                            height="32"
                            width="32"
                        >
                        Perusahaan Terinput:
                    </a>
                </div>
                <div class="flex items-center justify-center py-2">
                    <a class="btn border-darkgrey text-darkgrey bg-white hover:bg-darkgrey hover:text-white"
                    {{-- href="{{ route('perusahaan-tambah-blok1') }}"> --}}
                    href="#">
                        <img src="{{ url('logo/logo-tambah-lingkaran-2.png') }}"
                            alt=""
                            height="32"
                            width="32"
                        >
                        Tambah Perusahaan Baru
                    </a>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center py-8">

            @if ($pesan == 'tidak ditemukan')
            <div class="grid grid-cols-1 gap-8">
                <div class="card bg-base-100 sm:w-96 w-full shadow-xl">
                    <figure class="px-10 pt-10">
                    <img
                        src="{{ url('logo/logo-perusahaan.webp') }}"
                        alt="Shoes"
                        class="rounded-xl" style="width: 50px"/>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h2 class="card-title text-red">Perusahaan Tidak Ditemukan </h2>
                    </div>
                </div>
            </div>

            @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($perusahaans as $perusahaan)
                    <div class="card bg-white border border-darkgrey sm:w-96 w-full shadow-xl">
                        <figure class="px-10 pt-10">
                        <img
                            src="{{ url('logo/logo-perusahaan.webp') }}"
                            alt="Shoes"
                            class="rounded-xl" style="width: 50px"/>
                        </figure>
                        <div class="card-body items-center text-center">
                            <h2 class="card-title">{{!empty($perusahaan->nama_usaha)? $perusahaan->nama_usaha : ""}}</h2>
                            <p>{{!empty($perusahaan->alamat_sbr)? $perusahaan->alamat_sbr : ""}}</p>
                            <p class="text-sm">{{!empty($perusahaan->nip)? "latest edit by : ".$perusahaan->nip : ""}}</p>
                            <div class="card-actions">
                                <a href="{{route('perusahaan-view-petugas',['id_perusahaan' => $perusahaan->id_perusahaan])}}"
                                    class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey">update</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif

        </div>

        <div class="flex items-center justify-center pt-8 pb-16">
            {{-- {{$perusahaans->links('vendor.pagination.tailwind-2')}} --}}
            {{ $perusahaans->appends(request()->input())->links('vendor.pagination.tailwind-2') }}
        </div>

    </div>

    <script>
        // Tunggu sampai halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Setelah 2 detik, sembunyikan elemen toast
            setTimeout(function() {
                document.getElementById('myToast').style.display = 'none';
            }, 2000); // 2000ms = 2 detik
        });
    </script>

@endsection
