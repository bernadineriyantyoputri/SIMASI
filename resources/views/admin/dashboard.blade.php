@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="py-10 text-center">
    <div class="max-w-5xl mx-auto px-4">

        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-600 font-semibold text-sm">
            <i class="fa-solid fa-shield"></i>
            <span>Sistem Manajemen Terpadu</span>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold mt-4">
            Kelola UKM Anda dengan Lebih Efisien dan Terorganisir
        </h1>

        <p class="text-gray-500 max-w-2xl mx-auto mt-2">
            Platform all-in-one untuk mengelola anggota, kegiatan, absensi, dan keuangan UKM.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-3 mt-4">
            <a href="#fitur" class="bg-gray-900 text-white px-6 py-2 rounded-full">
                Mulai Sekarang →
            </a>
            <a href="#fitur" class="border border-gray-400 px-6 py-2 rounded-full">
                Pelajari Lebih Lanjut
            </a>
        </div>

        <!-- STAT CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">

            <!-- Card 1 -->
            <div class="bg-white rounded-2xl border shadow p-4 flex items-center gap-3">
                <div class="bg-blue-100 text-blue-600 flex items-center justify-center rounded-lg w-12 h-12">
                    <i class="fa-solid fa-people-group"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold">{{ $totalUsers ?? 0 }}</div>
                    <div class="text-gray-500 text-sm">Anggota Aktif</div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-2xl border shadow p-4 flex items-center gap-3">
                <div class="bg-blue-100 text-blue-600 flex items-center justify-center rounded-lg w-12 h-12">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold">{{ $totalKegiatan ?? 0 }}</div>
                    <div class="text-gray-500 text-sm">Kegiatan/Tahun</div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-2xl border shadow p-4 flex items-center gap-3">
                <div class="bg-blue-100 text-blue-600 flex items-center justify-center rounded-lg w-12 h-12">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold">{{ $absensiRate ?? 0 }}%</div>
                    <div class="text-gray-500 text-sm">Tingkat Kehadiran</div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FITUR -->
<section id="fitur" class="py-10">
    <div class="max-w-5xl mx-auto px-4">

        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold">Fitur Lengkap untuk Manajemen UKM</h2>
            <p class="text-gray-500">Semua yang Anda butuhkan dalam satu platform</p>
        </div>

        <!-- FITUR GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Pengguna -->
            <a href="{{ route('admin.pengguna.index') }}" class="block bg-white rounded-2xl border shadow p-5 hover:shadow-lg transition flex gap-4">
                <div class="bg-blue-100 text-blue-600 flex items-center justify-center rounded-lg w-12 h-12">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <h3 class="font-semibold">Manajemen Pengguna</h3>
                    <p class="text-gray-500 text-sm">Kelola data anggota dan pengurus UKM.</p>
                </div>
            </a>

            <!-- Kegiatan -->
            <a href="{{ route('admin.kegiatan.index') }}" class="block bg-white rounded-2xl border shadow p-5 hover:shadow-lg transition flex gap-4">
                <div class="bg-blue-100 text-blue-600 flex items-center justify-center rounded-lg w-12 h-12">
                    <i class="fa-solid fa-calendar"></i>
                </div>
                <div>
                    <h3 class="font-semibold">Manajemen Kegiatan</h3>
                    <p class="text-gray-500 text-sm">Buat dan kelola jadwal kegiatan.</p>
                </div>
            </a>

            <!-- Absensi -->
            <a href="{{ route('admin.absensi.index') }}" class="block bg-white rounded-2xl border shadow p-5 hover:shadow-lg transition flex gap-4">
                <div class="bg-green-100 text-green-600 flex items-center justify-center rounded-lg w-12 h-12">
                    <i class="fa-solid fa-clipboard-check"></i>
                </div>
                <div>
                    <h3 class="font-semibold">Monitoring Absensi</h3>
                    <p class="text-gray-500 text-sm">Catat kehadiran peserta setiap acara.</p>
                </div>
            </a>

            <!-- Kas -->
            <a href="{{ route('admin.kas.index') }}" class="block bg-white rounded-2xl border shadow p-5 hover:shadow-lg transition flex gap-4">
                <div class="bg-yellow-100 text-yellow-600 flex items-center justify-center rounded-lg w-12 h-12">
                    <i class="fa-solid fa-coins"></i>
                </div>
                <div>
                    <h3 class="font-semibold">Manajemen Kas</h3>
                    <p class="text-gray-500 text-sm">Kelola pemasukan & pengeluaran kas.</p>
                </div>
            </a>

        </div>

        <!-- CTA -->
        <div class="rounded-3xl p-10 text-center text-white mt-8"
             style="background: linear-gradient(135deg, #3b82f6 0%, #7c3aed 50%, #9333ea 100%);">

            <h3 class="text-xl font-semibold">Siap Untuk Memulai?</h3>
            <p class="text-purple-200 text-sm mt-2">Bergabunglah dengan UKM yang sudah menggunakan sistem ini.</p>

            <a href="{{ route('admin.dashboard') }}" class="mt-4 inline-block bg-white text-gray-900 px-6 py-2 rounded-full">
                Akses Sekarang →
            </a>
        </div>

    </div>
</section>

@endsection
