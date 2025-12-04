{{-- resources/views/layouts/partials/topbar.blade.php --}}

<nav class="fixed top-0 left-0 right-0 md:left-64 bg-white border-b border-gray-200 z-30">
    <div class="px-4 py-3 flex items-center justify-between">

        {{-- KIRI: Logo & judul --}}
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-black text-white flex items-center justify-center rounded">
                <i class="fa fa-user text-sm"></i>
            </div>
            <div>
                <div class="font-semibold leading-tight">SIMASI</div>
                <div class="text-xs text-gray-500">Sistem Manajemen dan Absensi UKM</div>
            </div>
        </div>

        {{-- KANAN: Tombol Dashboard + info user --}}
        <div class="flex items-center space-x-4">

            {{-- TOMBOL KEMBALI KE DASHBOARD (muncul kalau bukan di halaman dashboard) --}}
            @if (!request()->routeIs('admin.dashboard'))
                <a href="{{ route('admin.dashboard') }}"
                   class="hidden sm:inline-flex items-center px-3 py-1.5 text-xs font-semibold rounded-full
                          border border-gray-300 text-gray-700 hover:bg-gray-100">
                    ← Kembali ke Dashboard
                </a>
            @endif

            @php
                $user = auth()->user();
            @endphp

            {{-- Info role + avatar sederhana --}}
            <div class="flex items-center space-x-3">
                <div class="text-right text-xs">
                    <div class="font-semibold">
                        {{ $user->role === 'admin' ? 'Admin' : 'User' }}
                    </div>
                    <div class="text-gray-500">
                        {{ $user->name ?? 'Pengguna' }}
                    </div>
                </div>

                <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center text-xs font-semibold text-gray-700">
                    {{ strtoupper(Str::of($user->name ?? 'AD')->substr(0, 2)) }}
                </div>
            </div>
        </div>
    </div>
</nav>
