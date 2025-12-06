<aside class="fixed left-0 top-16 w-64 h-[calc(100%-4rem)] bg-white border-r border-gray-200 
             px-6 pt-6 pb-6 flex flex-col justify-between overflow-y-auto">

    <div class="space-y-2">

        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 p-3 rounded-xl 
           {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-blue-50' }}">
            <i class="fa fa-home w-5"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.kegiatan.index') }}"
           class="flex items-center gap-3 p-3 rounded-xl
           {{ request()->routeIs('admin.kegiatan.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-blue-50' }}">
            <i class="fa fa-calendar w-5"></i>
            <span>Kegiatan</span>
        </a>

        <a href="{{ route('admin.pengguna.index') }}"
           class="flex items-center gap-3 p-3 rounded-xl
           {{ request()->routeIs('admin.pengguna.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-blue-50' }}">
            <i class="fa fa-users w-5"></i>
            <span>Pengguna</span>
        </a>

        <a href="{{ route('admin.absensi.index') }}"
           class="flex items-center gap-3 p-3 rounded-xl
           {{ request()->routeIs('admin.absensi.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-blue-50' }}">
            <i class="fa fa-clipboard-check w-5"></i>
            <span>Absensi</span>
        </a>

        <a href="{{ route('admin.kas.index') }}"
           class="flex items-center gap-3 p-3 rounded-xl
           {{ request()->routeIs('admin.kas.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-blue-50' }}">
            <i class="fa fa-wallet w-5"></i>
            <span>Kas</span>
        </a>

    </div>


</aside>
