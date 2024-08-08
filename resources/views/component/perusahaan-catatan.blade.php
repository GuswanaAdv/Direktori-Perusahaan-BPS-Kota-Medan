<div role="alert" class="alert alert-info">
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        class="h-6 w-6 shrink-0 stroke-current">
        <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    Catatan : Ikuti urutan format kolom berikut
</div>
@include('component.perusahaan-format-kolom')
<a class="btn bg-grey text-black hover:bg-darkblue hover:text-white"
    href="{{ url('format-kolom/Format Kolom Perusahaan.xlsx') }}"
    id="download-link">
    <img src="https://cdn1.iconfinder.com/data/icons/unicons-line-vol-3/24/folder-download-64.png"
        alt="download-image"
        class="sm:mx-2 sm:w-8 w-4">
    Download Format Kolom Perusahaan!!
</a>
