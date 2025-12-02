<aside class="fixed left-0 top-0 w-64 h-full bg-white border-r border-gray-200 p-6 flex flex-col justify-between">

    <div class="space-y-3">
        <h2 class="text-lg font-bold mb-4">SIMASI UKM</h2>

        {{-- KEGIATAN (PALING ATAS) --}}
        <a href="/admin/kegiatan"
           class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 text-gray-700">
            <i class="fa fa-calendar w-5"></i>
            <span>Kegiatan</span>
        </a>

        {{-- PENGGUNA --}}
        <a href="/admin/pengguna"
           class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 text-gray-700">
            <i class="fa fa-users w-5"></i>
            <span>Pengguna</span>
        </a>

        {{-- ABSENSI --}}
        <a href="/admin/absensi"
           class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 text-gray-700">
            <i class="fa fa-clipboard-check w-5"></i>
            <span>Absensi</span>
        </a>

        {{-- KAS --}}
        <a href="/admin/kas"
           class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 text-gray-700">
            <i class="fa fa-wallet w-5"></i>
            <span>Kas</span>
        </a>
    </div>

    <form action="{{ route('logout') }}" method="POST" class="mt-6">
        @csrf
        <button type="submit"
                class="w-full flex items-center gap-3 p-3 text-red-600 hover:bg-red-50 rounded-xl font-medium">
            <i class="fa fa-right-from-bracket w-5"></i>
            Logout
        </button>
    </form>

</aside>
