@extends('layout.pegawai')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">
            <div class="card-body w-full text-2xl text-left sm:px-20 border-b-2 font-bold">
                Daftar Perusahaan yang belum diapprove
            </div>
            <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
                <div class="flex items-center justify-center py-8 w-full">
                    <div class="overflow-x-auto shadow-xl">
                        <table class="table table-zebra bg-white shadow-2xl">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th></th>
                                <th>Nama</th>
                                <th>Kegiatan</th>
                                <th>Keterangan</th>
                                <th>Periksa</th>
                                <th>Penyetujuan</th>
                            </tr>
                            </thead>

                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($pembaruans as $pembaruan)
                                    @php
                                        $no++;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $pembaruan->pegawai->nama_pegawai }}</td>
                                        <td>{{ $pembaruan->kegiatanStatistik->nama_kegiatan }}</td>
                                        <td>{{ $pembaruan->keterangan }}</td>
                                        <td><a href="{{ route('perusahaan-aproval-cek', ['id_pembaruan' => $pembaruan->id_pembaruan]) }}" class="btn bg-orange">Periksa</a></td>
                                        <td><a href="{{ route('perusahaan-aproval-proses', ['id_pembaruan' => $pembaruan->id_pembaruan]) }}" class="btn bg-orange">Setuju</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">

            </div>
        </div>
    </div>
@endsection
