<div class="navbar bg-darkblue py-4 shadow-xl">
    {{-- Tampilan Mobile --}}
    <div class="navbar-start text-white">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul tabindex="0"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow text-black">
                <li><a href="{{route('beranda')}}" class="hover:bg-blue">Beranda</a></li>
                <li><a href="{{route('kegiatan-statistik')}}" class="hover:bg-blue">Kegiatan Statistik</a></li>
                <li>
                    <a class="hover:bg-white">Direktori</a>
                      <ul class="p-2 w-32 text-black">
                        <li><a href="{{route('perusahaan')}}" class="hover:bg-blue">Perusahaan</a></li>
                        <li><a href="{{route('petugas')}}" class="hover:bg-blue">Petugas</a></li>
                      </ul>
                  </li>
                <li><a class="hover:bg-white btn p-0 mt-2" href="{{ route('profil') }}">Profil</a></li>
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="btn w-full p-0 mt-2">logout</button>
                </form>
            </ul>
        </div>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSskAcjFxQzZFo7W70mjP4OwNoovJe62tZ5Yw&s" class="w-16 mx-8 rounded-box">
        <a class="text-xl text-white font-bold">DIREKTORI PERUSAHAAN</a>
    </div>

    {{-- Tampilan Desktop --}}
    <div class="navbar-end hidden lg:flex mr-36 text-white z-10">
        <ul class="menu menu-horizontal px-1 space-x-2">
            <li><a href="{{route('beranda')}}" class="{{($judul == 'Beranda')? 'border-b-2 border-white' : ''}} hover:bg-blue">Beranda</a></li>
            <li><a href="{{route('kegiatan-statistik')}}" class="{{($judul == 'Kegiatan Statistik')? 'border-b-2 border-white' : ''}} hover:bg-blue">Kegiatan Statistik</a></li>
            <li>
              <details>
                <summary class="{{($judul == 'Perusahaan')||($judul == 'Petugas')? 'border-b-2 border-white' : ''}} hover:bg-blue">Direktori</summary>
                <ul class="p-2 w-32 shadow-lg text-black">
                  <li><a href="{{route('perusahaan')}}" class="hover:bg-blue">Perusahaan</a></li>
                  <li><a href="{{route('petugas')}}" class="hover:bg-blue">Petugas</a></li>
                </ul>
              </details>
            </li>
            <li>
                <details>
                  <summary class="hover:bg-blue {{($judul == 'Profil')? 'border-b-2 border-white' : ''}}">Akun</summary>
                  <ul class="p-2 w-56 shadow-lg text-black">
                    <li><a class="mt-4 hover:bg-transparent">Nama: {{ Auth::user()->pegawai->nama_pegawai }}</a></li>
                    <li><a class="mt-4 hover:bg-transparent">NIP: {{ Auth::user()->pegawai->nip }}</a></li>
                    <li><a href="{{ route('profil') }}" class="mt-4 btn">profil</a></li>
                    {{-- <li> --}}
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="my-4 btn w-full">logout</button>
                        </form>
                    {{-- </li> --}}
                  </ul>
                </details>
            </li>
          </ul>
    </div>
</div>
