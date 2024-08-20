<div>
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Kode Pos</span>
        </div>
        <input type="text" placeholder="Kode Pos" name="kode-pos" class="input input-bordered w-full max-w-xs" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Telepon</span>
        </div>
        <input type="text" placeholder="Telepon" name="telepon" class="input input-bordered w-full max-w-xs" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Email</span>
        </div>
        <input type="text" placeholder="Email" name="email" class="input input-bordered w-full max-w-xs" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Website</span>
        </div>
        <input type="text" placeholder="Website" name="website" class="input input-bordered w-full max-w-xs" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Pilih Kondisi Perusahaan</span>
        </div>
        <select class="select select-bordered" name="kode-kondisi-perusahaan" id="kode-kondisi-perusahaan">
            <option value="-">Pilih Kondisi Perusahaan</option>
            @foreach ($kondisiPerusahaans as $kondisiPerusahaan)
                <option value="{{ $kondisiPerusahaan->kode_kondisi_perusahaan }}">{{ $kondisiPerusahaan->nama_kondisi_perusahaan }}</option>
            @endforeach
        </select>
    </label>
    <div id="warning-message-kode-kondisi-perusahaan" style="display: none; color: red; text-align: center;">
        Silakan pilih kegiatan terlebih dahulu.
    </div>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Lattitude</span>
        </div>
        <input type="text" placeholder="Lattitude" name="lattitude" class="input input-bordered w-full max-w-xs" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Longitude</span>
        </div>
        <input type="text" placeholder="Longitude" name="longitude" class="input input-bordered w-full max-w-xs" required/>
    </label>
</div>
