<div class="sm:pl-2 pl-0">
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Nama Penanggung Jawab</span>
        </div>
        <input type="text" placeholder="Nama Penanggung Jawab" name="nama-penanggungjawab" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->nama_penanggungjawab }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Jenis Kelamin Penanggung Jawab</span>
        </div>
        <input type="text" placeholder="Jenis Kelamin Penanggung Jawab" name="jenis-kelamin-penanggungjawab" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->jenis_kelamin_penanggungjawab }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Tanggal Lahir Penanggung Jawab</span>
        </div>
        <input type="{{ ($perusahaan->tanggal_lahir_penanggungjawab == '-')? 'text' : 'date' }}" placeholder="Tanggal Lahir Penanggung Jawab" name="tanggal-lahir-penanggungjawab" class="input input-bordered w-full max-w-xs"
        value="{{ ($perusahaan->tanggal_lahir_penanggungjawab == '-')? $perusahaan->tanggal_lahir_penanggungjawab : date('Y-m-d', strtotime($perusahaan->tanggal_lahir_penanggungjawab)) }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Kewarganegaraan Penanggung Jawab</span>
        </div>
        <input type="text" placeholder="Kewarganegaraan Penanggung Jawab" name="kewarganegaraan-penanggungjawab" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->kewarganegaraan_penanggungjawab }}" required/>
    </label>
</div>
