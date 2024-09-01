<div class="overflow-x-auto w-full">
    <table class="table table-zebra w-full">
      <!-- head -->
      <thead>
        <tr>
          <th></th>
          <th>Kegiatan Statistik</th>
          <th>Tanggal Pencacahan</th>
          <th>Tanggal Penginputan</th>
          <th>Petugas</th>
          <th>Penginput</th>
          <th>Status Perusahaan</th>
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
                <td>{{!empty($row->tanggal_kegiatan)? date('d-m-Y', strtotime($row->tanggal_kegiatan)): " "}}</td>
                <td>{{!empty($row->tanggal_penginputan)? date('d-m-Y', strtotime($row->tanggal_penginputan)): " "}}</td>
                <td>{{!empty($row->nama_petugas)? $row->nama_petugas: " "}}</td>
                <td>{{!empty($row->pegawai->nama_pegawai)? $row->pegawai->nama_pegawai: " "}}</td>
                <td>{{!empty($row->status)? $row->status: " "}}</td>
            </tr>
        @endforeach

      </tbody>
    </table>
</div>
