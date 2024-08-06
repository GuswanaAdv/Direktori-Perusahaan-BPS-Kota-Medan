@if (session()->has('loginError'))
    <div role="alert" class="alert alert-error">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 shrink-0 stroke-current"
        fill="none"
        viewBox="0 0 24 24">
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('loginError') }}</span>
    </div>
@elseif(session()->has('sessionExpired'))
    <div role="alert" class="alert alert-error">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 shrink-0 stroke-current"
        fill="none"
        viewBox="0 0 24 24">
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('sessionExpired') }}</span>
    </div>
@elseif(session()->has('pesan-petugas'))
    <div role="alert" class="alert alert-error">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 shrink-0 stroke-current"
        fill="none"
        viewBox="0 0 24 24">
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session('pesan-petugas') }}</span>
    </div>
@elseif (session()->has('pesan-logout'))
    <div class="toast toast-top toast-center" id="myToast">
        <div class="alert bg-green text-white font-bold text-center">
            <span>{{ session('pesan-logout') }}</span>
        </div>
    </div>
@endif

<script>
    // Tunggu sampai halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Setelah 2 detik, sembunyikan elemen toast
        setTimeout(function() {
            document.getElementById('myToast').style.display = 'none';
        }, 2000); // 2000ms = 2 detik
    });
</script>
