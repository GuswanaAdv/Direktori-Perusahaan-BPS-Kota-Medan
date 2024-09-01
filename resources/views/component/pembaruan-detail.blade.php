<div class="font-bold text-xl p-4 bg-white w-full border-b-2">
    <p>Upload Data Updating Kegiatan {{$pembaruan->kegiatanStatistik->nama_kegiatan}}</p>
</div>
<div class="overflow-x-auto">
    <form class="mx-auto py-4 space-y-2 w-full" action="{{ route('perusahaan-update-proses') }}"
    id="form-update" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full flex items-center justify-center">
            <div class="grid grid-cols-1">
                <label class="block mb-2 text-sm font-bold text-black pl-2"
                    for="user_avatar">
                    <input type="hidden" value="{{ Auth::user()->pegawai->nip }}" name="nip">
                    <input type="hidden" value="{{ $pembaruan->id_pembaruan }}" name="id-pembaruan">
                    Upload File Berekstensi .xlsx
                </label>
                <div class="w-full flex items-center justify-center">
                    <input type="file" name="file" id="fileInput"
                        class="file-input file-input-success file-input-bordered w-full max-w-xs"
                        accept=".xlsx" required/>
                </div>
                <div class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                id="user_avatar_help">
                    pastikan urutan kolom excel sudah disusun dengan benar
                </div>
            </div>
        </div>

        <div id="preview" class="mt-4 w-full flex items-center justify-center"></div>

        <div class="w-full flex items-center justify-center">
            <button class="btn w-full max-w-xs bg-grey text-black hover:bg-orange hover:text-white"
                type="submit">
                UPLOAD
            </button>
        </div>
    </form>
    @include('component.script-preview')
</div>
