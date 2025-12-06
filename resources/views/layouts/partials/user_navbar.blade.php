<nav class="fixed top-0 left-0 w-full bg-white border-b border-gray-200 h-16 
            flex items-center justify-between px-6 z-50">

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

    <div class="flex items-center gap-4">

        <div class="flex flex-col text-right leading-tight">
            <span class="text-sm text-gray-700 font-semibold">
                {{ auth()->user()->name }}
            </span>

            <span class="text-xs text-gray-500">
                {{ auth()->user()->npm ?? 'NPM Tidak Ada' }}
            </span>
        </div>
        <a href="{{ route('profile.edit') }}">
    <img 
        src="{{ auth()->user()->photo 
            ? asset('storage/' . auth()->user()->photo) 
            : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) 
        }}"
        class="w-10 h-10 rounded-full border object-cover cursor-pointer hover:opacity-80 transition"
    />
</a>



        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 text-sm">
                Logout
            </button>
        </form>
    </div>

</nav>
