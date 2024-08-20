<div class="navbar bg-gradient-to-r from-darkorange to-lightorange py-4 shadow-xl">
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
                <li><a href="{{route('beranda-petugas')}}" class="{{($judul == 'Beranda')? 'bg-darkorange' : ''}} hover:bg-darkorange">
                    <img
                        src="{{ url('logo/logo-beranda.webp') }}"
                        width="20"
                        height="20"
                    />
                    Beranda
                </a></li>
                <li><a class="{{($judul == 'Profil')? 'bg-darkgrey' : ''}} hover:bg-darkgrey hover:text-white btn p-0 mt-2" href="{{ route('profil-petugas') }}">
                    <img
                        src="{{ url('logo/logo-profil.webp') }}"
                        width="20"
                        height="20"
                    />
                    Profil
                </a></li>
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf

                    <button type="submit" class="hover:bg-darkgrey hover:text-white btn w-full p-0 mt-2">
                        <img
                            src="{{ url('logo/logo-logout.webp') }}"
                            width="20"
                            height="20"
                        />
                        logout
                    </button>
                </form>
            </ul>
        </div>
        <img src="{{ url('logo/logo-bps.png') }}" class="w-16 mx-8">
        <a class="text-xl text-white font-bold">DIREKTORI PERUSAHAAN KOTA MEDAN</a>
    </div>

    {{-- Tampilan Desktop --}}
    <div class="navbar-end hidden lg:flex md:mr-36 ml-20 text-white z-10">
        <ul class="menu menu-horizontal px-1 space-x-2">
            <li><a href="{{route('beranda-petugas')}}" class="{{($judul == 'Beranda')? 'border-b-2 border-white' : ''}} hover:bg-darkorange">
                Beranda
            </a></li>
            <li>
                <details>
                    <summary class="hover:bg-darkorange {{($judul == 'Profil')? 'border-b-2 border-white' : ''}}">
                        Akun
                    </summary>
                    <ul class="p-2 w-56 shadow-lg text-black">
                        <li><a class="mt-4 hover:bg-transparent">
                            <img
                                src="{{ url('logo/logo-tanda-panah-kanan.webp') }}"
                                width="20"
                                height="20"
                            />
                            Nama: {{ strlen(Auth::user()->petugas->nama_petugas) <= 12 ? Auth::user()->petugas->nama_petugas : explode(' ', Auth::user()->petugas->nama_petugas)[0] }}
                        </a></li>
                        <li><a href="{{ route('profil-petugas') }}" class="mt-4 btn">
                            <img
                                src="{{ url('logo/logo-profil.webp') }}"
                                width="20"
                                height="20"
                            />
                            profil
                        </a></li>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="my-4 btn w-full">
                                <img
                                    src="{{ url('logo/logo-logout.webp') }}"
                                    width="20"
                                    height="20"
                                />
                                logout
                            </button>
                        </form>
                    </ul>
                </details>
            </li>
          </ul>
    </div>
</div>
