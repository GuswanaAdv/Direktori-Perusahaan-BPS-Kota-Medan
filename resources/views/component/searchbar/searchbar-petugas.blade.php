<div class="flex items-center justify-center w-full py-4">
    @if ($judul == 'Beranda')
        <form class="max-w-md mx-auto w-full" action="{{ route('perusahaan-search2-petugas') }}" method="GET" id="cari" name="cari">
    @elseif ($judul == 'Kegiatan Statistik')
        <form class="max-w-md mx-auto w-full" action="{{ route('kegiatan-statistik-search2-petugas') }}" method="GET" id="cari" name="cari">
    @endif

        @csrf
        <div class="w-full">
            <div class="relative w-full">
                <input type="text"
                id="search"
                name="search"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-l-lg rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                @if ($judul == 'Beranda')
                    placeholder="Cari perusahaan..."
                    value="{{($cari != '-' )? $cari : ''}}"
                @elseif($judul == 'Kegiatan Statistik')
                    placeholder="Cari kegiatan statistik..."
                    value="{{($cari != '-' )? $cari : ''}}"
                @endif
                required />
                <button type="submit" class="absolute top-0 end-0 h-full p-2.5 text-sm font-medium text-white bg-orange rounded-e-lg hover:bg-lightorange focus:ring-4 focus:outline-none focus:ring-orange dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>
    </form>
</div>
