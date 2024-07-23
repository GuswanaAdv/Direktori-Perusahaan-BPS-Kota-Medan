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
                <li><a>Perusahaan</a></li>
                <li><a>Petugas</a></li>
                <li>
                    <a>Direktori</a>
                      <ul class="p-2 w-32 text-black">
                        <li><a>Perusahaan</a></li>
                        <li><a>Petugas</a></li>
                      </ul>
                  </li>
                <li><a>Akun</a></li>
            </ul>
        </div>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSskAcjFxQzZFo7W70mjP4OwNoovJe62tZ5Yw&s" class="w-16 mx-8 rounded-box">
        <a class="text-xl text-white font-bold">DIREKTORI PERUSAHAAN</a>
    </div>

    {{-- Tampilan Desktop --}}
    <div class="navbar-end hidden lg:flex mr-36 text-white">
        <ul class="menu menu-horizontal px-1">
            <li><a href="{{route('beranda')}}" class="{{($judul == 'Beranda')? 'border-b border-white' : ''}}">Beranda</a></li>
            <li><a href="{{route('survei')}}" class="{{($judul == 'Survei')? 'border-b border-white' : ''}}">Survei</a></li>
            <li>
              <details>
                <summary class="{{($judul == 'Perusahaan')||($judul == 'Petugas')? 'border-b border-white' : ''}}">Direktori</summary>
                <ul class="p-2 w-32 shadow-lg text-black">
                  <li><a href="{{route('perusahaan')}}">Perusahaan</a></li>
                  <li><a href="{{route('petugas')}}">Petugas</a></li>
                </ul>
              </details>
            </li>
            <li>
                <details>
                  <summary>Akun</summary>
                  <ul class="p-2 w-56 shadow-lg text-black">
                    <li><a class="mt-4 hover:bg-transparent">username: ...</a></li>
                    <li><a class="mt-4 hover:bg-transparent">team: .....</a></li>
                    <li><a class="mt-4 hover:bg-transparent">email: .....</a></li>
                    <li><a href="" class="mt-4 btn">lengkap</a></li>
                    <li><a href="{{route('login')}}" class="my-4 btn">logout</a></li>
                  </ul>
                </details>
            </li>
          </ul>
    </div>
</div>