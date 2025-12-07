<nav class="fixed bottom-0 left-0 w-full bg-white border-t shadow-md z-50">
    <div class="grid grid-cols-4 text-center py-2 text-sm">

        {{-- Kegiatan --}}
        <a href="{{ url('/kegiatan') }}"
           class="flex flex-col items-center justify-center gap-1
                  {{ request()->is('kegiatan*') ? 'text-blue-600' : 'text-gray-700' }}">
            <i class="fa-solid fa-calendar text-lg"></i>
            <span class="text-xs">Kegiatan</span>
        </a>

        {{-- Absensi --}}
        <a href="{{ url('/absensi') }}"
           class="flex flex-col items-center justify-center gap-1
                  {{ request()->is('absensi*') ? 'text-blue-600' : 'text-gray-700' }}">
            <i class="fa-solid fa-border-all text-lg"></i>
            <span class="text-xs">Absensi</span>
        </a>

        {{-- Riwayat --}}
        <a href="{{ url('/riwayat') }}"
           class="flex flex-col items-center justify-center gap-1
                  {{ request()->is('riwayat*') ? 'text-blue-600' : 'text-gray-700' }}">
            <i class="fa-solid fa-clock-rotate-left text-lg"></i>
            <span class="text-xs">Riwayat</span>
        </a>

        {{-- Profil --}}
        <a href="{{ url('/profile') }}"
           class="flex flex-col items-center justify-center gap-1
                  {{ request()->is('profile*') ? 'text-blue-600' : 'text-gray-700' }}">
            <i class="fa-solid fa-user text-lg"></i>
            <span class="text-xs">Profil</span>
        </a>

    </div>
</nav>
