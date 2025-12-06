<nav class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur-md
            border-b border-gray-200 z-30 shadow-sm w-full">

    <div class="w-full px-6 py-3 flex items-center justify-between">

        <a href="/" class="flex items-center space-x-3">

            <img src="{{ asset('images/logo.png') }}"
                 alt="Logo"
                 class="w-10 h-10 rounded-lg object-cover">

            <div class="leading-tight">
                <div class="font-semibold text-gray-800 text-base">
                    UKM Management System
                </div>
                <div class="text-gray-500 text-sm">
                    Sistem Informasi Manajemen UKM
                </div>
            </div>

        </a>

        <div class="flex items-center gap-2">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-gray-900 text-white text-sm rounded-full
                           hover:bg-black transition flex items-center gap-2">
                    Logout
                    <i class="fa-solid fa-right-from-bracket text-xs"></i>
                </button>
            </form>
        </div>

    </div>
</nav>
