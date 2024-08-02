<div class="overflow-x-auto w-full">
    <table class="table table-zebra w-full">
      <!-- head -->
      <thead>
        <tr>
          <th></th>
          <th>Kegiatan Statistik</th>
          <th>Petugas</th>
          <th>Tanggal</th>
          <th>Penanggungjawab</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        @php
            $no = ($perusahaanKegiatans->currentPage() - 1) * $perusahaanKegiatans->perPage();
        @endphp
        @foreach ($perusahaanKegiatans as $row)
            @php
                $no++;
            @endphp
            <tr>
                <th>{{$no}}</th>
                <td>{{!empty($row->kegiatanStatistik->nama_kegiatan)? $row->kegiatanStatistik->nama_kegiatan: " "}}</td>
                <td>{{!empty($row->petugas->nama_petugas)? $row->petugas->nama_petugas: " "}}</td>
                <td>{{!empty($row->tanggal_kegiatan)? $row->tanggal_kegiatan: " "}}</td>
                <td>{{!empty($row->pegawai->nama_pegawai)? $row->pegawai->nama_pegawai: " "}}</td>
                <td>{{!empty($row->keterangan)? $row->keterangan: " "}}</td>
            </tr> 
        @endforeach

      </tbody>
    </table>
</div>