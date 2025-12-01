@extends('layouts.app')

@section('content')

<div class="kegiatan-wrapper pt-[120px] px-4 md:px-8">

    <!-- Judul Halaman -->
    <h1 class="kegiatan-title text-2xl font-bold mb-1">Daftar Kegiatan</h1>
    <p class="text-gray-600 mb-6">Pilih kegiatan yang ingin kamu ikuti</p>

    <!-- Grid Card Kegiatan -->
    <div class="kegiatan-grid">

        @foreach ($kegiatan as $k)
        <div class="kegiatan-card">

            <!-- Gambar -->
           <img 
           src="{{ $k->gambar ? asset('storage/' . $k->gambar) : asset('images/no-image.jpg') }}"
           alt="kegiatan"
           class="w-full h-40 object-cover rounded-lg mb-4">


            <div class="px-4 mt-3">

                <!-- Judul -->
                <div class="keg-title font-semibold text-lg">
                    {{ $k->judul }}
                </div>

                <!-- Deskripsi -->
                <div class="keg-desc text-sm text-gray-600 mt-1">
                    {{ $k->deskripsi }}
                </div>

                <!-- INFO (SAMA DENGAN ADMIN) -->
                <div class="mt-4 space-y-2 text-sm text-gray-700">

                    <!-- Tanggal -->
                    <div class="flex items-center gap-2">
                        <i class="fa fa-calendar"></i>
                        <span>
                            {{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('l, d F Y') }}
                            - {{ $k->waktu }}
                        </span>
                    </div>

                    <!-- Lokasi -->
                    <div class="flex items-center gap-2">
                        <i class="fa fa-location-dot"></i>
                        <span>{{ $k->lokasi }}</span>
                    </div>

                    <!-- Peserta -->
                    <div class="flex items-center gap-2">
                        <i class="fa fa-users"></i>
                        <span>{{ $k->peserta }} / {{ $k->kuota }} peserta</span>
                    </div>

                    

                </div>

                <!-- Tombol -->
             <a href="{{ route('user.kegiatan.detail', $k->id) }}"
   style="display:inline-block; margin-top:16px; padding:8px 16px; background-color:#1D4ED8; color:white; font-weight:bold; border-radius:8px; text-decoration:none;">
   Lihat Detail
</a>

            </div>

        </div>
        @endforeach

    </div>

</div>

@endsection
