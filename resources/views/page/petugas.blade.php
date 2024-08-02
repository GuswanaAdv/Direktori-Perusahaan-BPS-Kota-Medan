@extends('layout.app')
@section('content')
    @include('component.searchbar')
    <div id="beranda" class="bg-lightgrey">
        <div class="flex items-center justify-center pt-4">
            <div class="flex sm:space-x-12 grid sm:grid-cols-2 grid-cols-1">
                <div class="flex items-center justify-center py-4">
                    <button class="btn border-darkblue text-darkblue bg-white hover:border-darkblue hover:bg-white hover:text-darkblue">
                        Daftar Petugas:
                    </button>
                </div>
                <div class="flex items-center justify-center py-4">
                    <button class="btn border-darkblue text-darkblue bg-white hover:bg-darkblue hover:text-white">
                        Tambah Petugas
                        <img src="https://cdn1.iconfinder.com/data/icons/unicons-line-vol-5/24/plus-circle-64.png" 
                        alt=""
                        height="32"
                        width="32">
                    </button>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center py-8 w-full">
            <div class="overflow-x-auto">
                <table class="table table-zebra bg-white">
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
                                    <label for="my_modal_6" class="btn bg-transparent hover:bg-darkblue px-2 w-12 h-12">
                                        <img 
                                            src="https://cdn1.iconfinder.com/data/icons/unicons-line-vol-3/24/edit-64.png"
                                            width="24"
                                            height="24">
                                    </label>
                                    <!-- Put this part before </body> tag -->
                                    <input type="checkbox" id="my_modal_6" class="modal-toggle" />
                                    <div class="modal" role="dialog">
                                    <div class="modal-box w-11/12 max-w-5xl bg-blue">
                                        @include('component.petugas-detail')
                                        <div class="modal-action">
                                            <label for="my_modal_6" class="btn bg-grey border-grey hover:bg-darkblue hover:text-white">
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