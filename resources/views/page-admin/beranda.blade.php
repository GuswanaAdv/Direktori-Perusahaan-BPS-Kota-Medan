@extends('layout.admin')
@section('content')
    @include('component.searchbar.searchbar-admin')

    @include('component.pesan')

    <div id="beranda" class="bg-white">
        <div class="flex items-center justify-center pt-4">
            <div class="flex sm:space-x-12 grid sm:grid-cols-2 grid-cols-1">
                <div class="flex items-center justify-center py-4">
                    <button class="btn border-darkgrey text-darkgrey bg-white hover:border-darkgrey hover:bg-white hover:text-darkgrey">
                        <img src="{{ url('logo/logo-list-2.png') }}"
                            alt=""
                            height="32"
                            width="32"
                        >
                        Daftar Pegawai:
                    </button>
                </div>
                <div class="flex items-center justify-center py-4">
                    <a href="{{ route('pegawai-tambah') }}" class="btn border-darkgrey text-darkgrey bg-white hover:bg-darkgrey hover:text-white">
                        <img src="{{ url('logo/logo-tambah-lingkaran-2.png') }}"
                            alt=""
                            height="32"
                            width="32"
                        >
                        Tambah Pegawai
                    </a>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center py-8 w-full">
            <div class="overflow-x-auto shadow-xl">
                <table class="table table-zebra bg-white shadow-2xl">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th></th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Email</th>
                        <th>Tim</th>
                        <th>Jabatan</th>
                        <th>Jenis Kelamin</th>
                        <th>No WA</th>
                        <th>Alamat</th>
                    </tr>
                    </thead>

                    <tbody>
                        @php
                            $no = ($pegawais->currentPage() - 1) * $pegawais->perPage();
                        @endphp

                        @foreach ($pegawais as $pegawai)
                            @php
                                $no++;
                            @endphp
                            <!-- row 1 -->
                            <tr>
                                <th>{{$no}}</th>
                                <td>{{!empty($pegawai->nama_pegawai)? $pegawai->nama_pegawai : ""}}</td>
                                <td>{{!empty($pegawai->nip)? $pegawai->nip : ""}}</td>
                                <td>{{!empty($pegawai->user->email)? $pegawai->user->email : ""}}</td>
                                <td>{{!empty($pegawai->timKerja->nama_tim_kerja)? $pegawai->timKerja->nama_tim_kerja : ""}}</td>
                                <td>{{!empty($pegawai->jabatan->nama_jabatan)? $pegawai->jabatan->nama_jabatan : ""}}</td>
                                <td>{{!empty($pegawai->jenis_kelamin)? $pegawai->jenis_kelamin : ""}}</td>
                                <td>{{!empty($pegawai->no_wa)? $pegawai->no_wa : ""}}</td>
                                <td>{{!empty($pegawai->alamat)? $pegawai->alamat : ""}}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-center justify-center pb-16">
            {{ $pegawais->appends(request()->input())->links('vendor.pagination.tailwind-2') }}
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
