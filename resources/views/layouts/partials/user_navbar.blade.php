<nav class="fixed top-0 left-0 w-full bg-white border-b border-gray-200 h-16 
            flex items-center justify-between px-6 z-50">

    <!-- LEFT: LOGO + TITLE -->
    <div class="flex items-center gap-3">
        <img src="https://img.icons8.com/?size=100&id=61005&format=png"
             class="w-9 h-9" alt="logo">

        <div class="flex flex-col leading-none">
            <span class="font-semibold text-gray-800 text-sm">SIMASI</span>
            <span class="text-[11px] text-gray-500">Sistem Manajemen dan Absensi UKM</span>
        </div>
    </div>

    <!-- RIGHT: USER INFO -->
    <div class="flex items-center gap-4">

        <div class="flex flex-col text-right leading-tight">
            <span class="text-sm text-gray-700 font-semibold">
                {{ auth()->user()->name }}
            </span>

            <span class="text-xs text-gray-500">
                {{ auth()->user()->npm ?? 'NPM Tidak Ada' }}
            </span>
        </div>

        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
             class="w-10 h-10 rounded-full border">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 text-sm">
                Logout
            </button>
        </form>
    </div>

</nav>
