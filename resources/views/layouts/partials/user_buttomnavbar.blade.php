<nav class="fixed bottom-0 left-0 w-full bg-white border-t shadow-md z-50">
    <div class="grid grid-cols-4 text-center py-2">

        <a href="{{ route('user.kegiatan.index') }}"
           class="flex flex-col items-center {{ request()->is('kegiatan*') ? 'text-blue-600' : 'text-gray-700' }}">
            <i class="fa-solid fa-calendar text-xl"></i>
            <span class="text-xs mt-1">Kegiatan</span>
        </a>

        <a href="{{ route('user.absensi.index') }}"
           class="flex flex-col items-center {{ request()->is('absensi*') ? 'text-blue-600' : 'text-gray-700' }}">
            <i class="fa-solid fa-border-all text-xl"></i>
            <span class="text-xs mt-1">Absensi</span>
        </a>

        <a href="{{ route('user.riwayat.index') }}"
           class="flex flex-col items-center {{ request()->is('riwayat*') ? 'text-blue-600' : 'text-gray-700' }}">
            <i class="fa-solid fa-clock-rotate-left text-xl"></i>
            <span class="text-xs mt-1">Riwayat</span>
        </a>

        <a href="{{ route('profile.edit') }}"
           class="flex flex-col items-center {{ request()->is('profil*') ? 'text-blue-600' : 'text-gray-700' }}">
            <i class="fa-solid fa-user text-xl"></i>
            <span class="text-xs mt-1">Profil</span>
        </a>

    </div>
</nav>
