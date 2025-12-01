<nav class="w-full bg-white border-b shadow-sm py-4 px-6 pl-10 flex items-center justify-between">


    <!-- LEFT -->
    <div class="flex items-center space-x-3">

        <!-- Text -->
        <div>
            <div class="text-3xl tracking-wide" style="font-weight: 1000;">
                SIMASI
            </div>

            <div class="text-base text-gray-500 -mt-1">
                Sistem Manajemen dan Absensi Kegiatan UKM
            </div>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="text-right">
        <div class="text-sm font-medium text-gray-700">
            {{ Auth::user()->name ?? 'Nama User' }}
        </div>

        <div class="text-xs text-gray-500">
            {{ Auth::user()->nim ?? '12345678' }}
        </div>
    </div>

</nav>
