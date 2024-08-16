@extends('layout.pegawai')
@section('content')
    @include('component.searchbar')
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
                        Daftar Petugas:
                    </button>
                </div>
                <div class="flex items-center justify-center py-4">
                    <a href="{{route('petugas-tambah')}}" class="btn border-darkgrey text-darkgrey bg-white hover:bg-darkgrey hover:text-white">
                        <img src="{{ url('logo/logo-tambah-lingkaran-2.png') }}"
                            alt=""
                            height="32"
                            width="32"
                        >
                        Tambah Petugas
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
                        <th>Jenis Kelamin</th>
                        <th>Usia</th>
                        <th>No WA</th>
                        <th>Alamat</th>
                        <th>Riwayat</th>
                    </tr>
                    </thead>

                    <tbody>
                        @php
                            $no = ($petugass->currentPage() - 1) * $petugass->perPage();
                        @endphp

                        @foreach ($petugass as $petugas)
                            @php
                                $no++;
                            @endphp
                            <!-- row 1 -->
                            <tr>
                                <th>{{$no}}</th>
                                <td>{{!empty($petugas->nama_petugas)? $petugas->nama_petugas : ""}}</td>
                                <td>{{!empty($petugas->jenis_kelamin)? $petugas->jenis_kelamin : ""}}</td>
                                <td>{{!empty($petugas->usia)? $petugas->usia : ""}}</td>
                                <td>{{!empty($petugas->no_wa)? $petugas->no_wa : ""}}</td>
                                <td>{{!empty($petugas->alamat)? $petugas->alamat : ""}}</td>
                                <td>
                                    <label for="my_modal_{{ $petugas->id_petugas }}" class="btn bg-transparent hover:bg-orange px-2 w-12 h-12">
                                        <img
                                            src="{{ url('logo/logo-lengkap-2.png') }}"
                                            width="24"
                                            height="24">
                                    </label>
                                    <!-- Put this part before </body> tag -->
                                    <input type="checkbox" id="my_modal_{{ $petugas->id_petugas }}" class="modal-toggle" />
                                    <div class="modal" role="dialog">
                                        <div class="modal-box w-11/12 max-w-5xl bg-orange">
                                            @include('component.petugas-detail')
                                            <div class="modal-action">
                                                <label for="my_modal_{{ $petugas->id_petugas }}" class="btn bg-grey hover:bg-darkgrey hover:text-white">
                                                    Tutup!
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-center justify-center pb-16">
            {{ $petugass->appends(request()->input())->links('vendor.pagination.tailwind-2') }}
        </div>

    </div>

@endsection
