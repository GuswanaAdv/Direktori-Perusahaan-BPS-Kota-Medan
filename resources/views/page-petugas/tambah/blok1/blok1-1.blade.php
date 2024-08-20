<div class="sm:pl-2 pl-0">
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Kode Kegiatan</span>
        </div>
        <input type="text" placeholder="Kode Kegiatan" name="kode-kegiatan"
        class="input input-bordered w-full max-w-xs"
        value="{{ Auth::user()->petugas->kegiatanStatistik->kode_kegiatan }}"
        required readonly/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Nama Kegiatan</span>
        </div>
        <input type="text" placeholder="Nama Kegiatan" name="nama-kegiatan"
        class="input input-bordered w-full max-w-xs"
        value="{{ Auth::user()->petugas->kegiatanStatistik->nama_kegiatan }}"
        required readonly/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">ID Petugas</span>
        </div>
        <input type="text" placeholder="ID Petugas" name="id-petugas"
        class="input input-bordered w-full max-w-xs"
        value="{{ Auth::user()->petugas->id_petugas }}"
        required readonly/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Nama Petugas</span>
        </div>
        <input type="text" placeholder="Nama Petugas" name="nama-petugas"
        class="input input-bordered w-full max-w-xs"
        value="{{ Auth::user()->petugas->nama_petugas }}"
        required readonly/>
    </label>
</div>

<div>
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">ID Perusahaan</span>
        </div>
        <input type="text" placeholder="ID Perusahaan" name="id-perusahaan" class="input input-bordered w-full max-w-xs"
        value="" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">ID SBR</span>
        </div>
        <input type="text" placeholder="ID SBR" name="id-sbr" class="input input-bordered w-full max-w-xs" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Nama Usaha</span>
        </div>
        <input type="text" placeholder="Nama Usaha" name="nama-usaha" class="input input-bordered w-full max-w-xs" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Nama Komersial</span>
        </div>
        <input type="text" placeholder="Nama Komersial" name="nama-komersial" class="input input-bordered w-full max-w-xs" required/>
    </label>
</div>
