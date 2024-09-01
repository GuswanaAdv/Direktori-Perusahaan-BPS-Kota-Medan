@extends('layout.pegawai')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">
            <div class="card-body w-full text-2xl text-left sm:px-20 border-b-2 font-bold">
                Daftar Tugas Update Data Perusahaan
            </div>
            @include('component.pesan')
            <div class="card-body w-full text-left sm:px-20 font-bold">
                <div class="flex items-center justify-center py-8 w-full">
                    <div class="overflow-x-auto shadow-xl">
                        <table class="table table-zebra bg-white shadow-2xl">
                            <!-- head -->
                            <thead>
                            <tr class="text-center">
                                <th></th>
                                <th>Nama</th>
                                <th>Kegiatan</th>
                                <th>Keterangan</th>
                                <th>Download Data</th>
                                <th>Update</th>
                            </tr>
                            </thead>

                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @if (count($pembaruans) == 0)
                                    <tr>
                                        <td colspan="6" class="text-center text-red">Belum ada pembaruan data perusahaan</td>
                                    </tr>
                                @else
                                    @foreach ($pembaruans as $pembaruan)
                                        @if ($pembaruan->pegawai->kode_tim_kerja == Auth::user()->pegawai->kode_tim_kerja)
                                            @php
                                                $no++;
                                            @endphp
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ !empty($pembaruan->pegawai->nama_pegawai)? $pembaruan->pegawai->nama_pegawai : ''}}</td>
                                                <td>{{ !empty($pembaruan->kegiatanStatistik->nama_kegiatan)? $pembaruan->kegiatanStatistik->nama_kegiatan : ''}}</td>
                                                <td>{{ !empty($pembaruan->keterangan)? $pembaruan->keterangan : '' }}</td>
                                                <td>
                                                    <a href="{{ route('perusahaan-aproval-cek', ['id_pembaruan' => $pembaruan->id_pembaruan]) }}"
                                                    class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey">Download</a>
                                                </td>
                                                <td>
                                                    <label for="my_modal_{{ $pembaruan->id_pembaruan }}" class="btn bg-blue text-white hover:bg-yellowpastel hover:text-darkgrey px-8 w-20 h-12">
                                                        Update
                                                    </label>
                                                    <!-- Put this part before </body> tag -->
                                                    <input type="checkbox" id="my_modal_{{ $pembaruan->id_pembaruan }}" class="modal-toggle" />
                                                    <div class="modal" role="dialog">
                                                        <div class="modal-box w-11/12 max-w-5xl bg-white">
                                                            <div class="flex items-center justify-center">
                                                                <div class="w-full">@include('component.pembaruan-detail')</div>
                                                            </div>
                                                            <div class="modal-action">
                                                                <label for="my_modal_{{ $pembaruan->id_pembaruan }}" class="btn bg-grey hover:bg-darkgrey hover:text-white">
                                                                    Tutup!
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($no == 0)
                                            <tr>
                                                <td colspan="6" class="text-center text-red">Belum ada pembaruan data perusahaan</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
