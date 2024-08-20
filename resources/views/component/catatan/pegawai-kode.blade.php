<div class="grid sm:grid-cols-2 grid-cols-1 mt-0">
    <div class="card-body w-full mx-2">
        <div class="overflow-x-auto w-full">
            <p>Keterangan Tim Kerja</p>
            <table class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <td>id_tim_kerja</td>
                        <td>nama_tim_kerja</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timKerjas as $timKerja)
                        <tr>
                            <td>{{ !empty($timKerja->id_tim_kerja)? $timKerja->id_tim_kerja : ""}}</td>
                            <td>{{ !empty($timKerja->nama_tim_kerja)? $timKerja->nama_tim_kerja : ""}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body w-full mx-2">
        <div class="overflow-x-auto w-full">
            <p>Keterangan Jabatan</p>
            <table class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <td>id_jabatan</td>
                        <td>nama_jabatan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jabatans as $jabatan)
                    <tr>
                        <td>{{ !empty($jabatan->id_jabatan)? $jabatan->id_jabatan : "" }}</td>
                        <td>{{ !empty($jabatan->nama_jabatan)? $jabatan->nama_jabatan : "" }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
