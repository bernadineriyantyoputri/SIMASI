<aside class="w-64 h-screen bg-white border-r shadow-sm fixed left-0 top-0">
    <!-- Header Sidebar -->
    <div class="px-6 py-5 border-b">
        <h1 class="text-xl font-bold">Admin Dashboard UKM</h1>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-4 space-y-1">

        <!-- Manajemen Pengguna -->
        <a href="/admin/pengguna" 
           class="flex items-center gap-3 px-6 py-3 hover:bg-gray-100 text-gray-700">
            <i class="fa fa-users"></i>
            <span>Manajemen Pengguna</span>
        </a>

        <!-- Manajemen Kegiatan -->
        <a href="/admin/kegiatan" 
           class="flex items-center gap-3 px-6 py-3 bg-blue-50 text-blue-700 font-semibold">
            <i class="fa fa-calendar"></i>
            <span>Manajemen Kegiatan</span>
        </a>

        <!-- Monitoring Absensi -->
        <a href="/admin/absensi" 
           class="flex items-center gap-3 px-6 py-3 hover:bg-gray-100 text-gray-700">
            <i class="fa fa-clipboard-check"></i>
            <span>Monitoring Absensi</span>
        </a>

        <!-- Manajemen Kas -->
        <a href="/admin/kas" 
           class="flex items-center gap-3 px-6 py-3 hover:bg-gray-100 text-gray-700">
            <i class="fa fa-wallet"></i>
            <span>Manajemen Kas</span>
        </a>

    </nav>
</aside>
