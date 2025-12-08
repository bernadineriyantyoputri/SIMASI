{{-- SIDEBAR ADMIN --}}
@php
    $admin = auth()->user();
@endphp

<aside class="w-64 bg-white shadow fixed inset-y-0 left-0 z-40 overflow-y-auto">

    {{-- HEADER: FOTO + NAMA ADMIN --}}
    <div class="p-6 border-b flex items-center gap-3">
        @if ($admin && $admin->photo)
            <img src="{{ asset('storage/' . $admin->photo) }}"
                 alt="Foto Admin"
                 class="w-10 h-10 rounded-full object-cover border">
        @else
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-lg font-semibold text-blue-700">
                {{ $admin ? strtoupper(substr($admin->name, 0, 1)) : 'A' }}
            </div>
        @endif

        <div class="overflow-hidden">
            <h1 class="text-sm font-semibold truncate">
                {{ $admin?->name ?? 'SIMASI Admin' }}
            </h1>
            <p class="text-xs text-gray-500 truncate">
                {{ $admin?->npm ?? 'Dashboard' }}
            </p>
        </div>
    </div>

    {{-- NAVIGASI --}}
    <nav class="p-4 space-y-1">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg
                  {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-gauge"></i>
            <span>Dashboard</span>
        </a>

        {{-- Profil Admin --}}
        <a href="{{ route('admin.profile') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg
                  {{ request()->routeIs('admin.profile') || request()->routeIs('admin.profile.edit') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-user"></i>
            <span>Profil</span>
        </a>

        {{-- Manajemen Pengguna --}}
        <a href="{{ route('admin.pengguna.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg
                  {{ request()->is('admin/pengguna*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-users"></i>
            <span>Pengguna</span>
        </a>

        {{-- Kegiatan --}}
        <a href="{{ route('admin.kegiatan.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg
                  {{ request()->is('admin/kegiatan*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-calendar-days"></i>
            <span>Kegiatan</span>
        </a>

        {{-- Absensi --}}
        <a href="{{ route('admin.absensi.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg
                  {{ request()->is('admin/absensi*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-clipboard-check"></i>
            <span>Absensi</span>
        </a>

        {{-- Kas --}}
        <a href="{{ route('admin.kas.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg
                  {{ request()->is('admin/kas*') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-wallet"></i>
            <span>Kas</span>
        </a>

        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-left hover:bg-red-100 text-red-600">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>

    </nav>
</aside>
