@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto py-6 px-4">

    {{-- Tombol kembali --}}
    <a href="{{ route('user.kegiatan.index') }}"
       class="text-gray-600 hover:underline mb-4 inline-block text-sm">
        ← Kembali
    </a>

    <!-- CARD -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border">

        <!-- GAMBAR -->
        <div class="w-full h-64 md:h-80 overflow-hidden">
            <img 
                src="{{ $kegiatan->gambar ? asset('storage/' . $kegiatan->gambar) : asset('images/no-image.jpg') }}"
                alt="{{ $kegiatan->judul }}"
                class="w-full h-full object-cover"
            >
        </div>

        <!-- ISI -->
        <div class="p-6">

            <!-- Judul -->
            <h2 class="font-bold text-3xl text-gray-800 mb-3">
                {{ $kegiatan->judul }}
            </h2>

            <!-- Deskripsi -->
            <p class="text-gray-600 leading-relaxed mb-6">
                {{ $kegiatan->deskripsi }}
            </p>

            <!-- INFORMASI -->
            <div class="space-y-4 text-sm">

                <div class="flex items-center gap-3">
                    <i class="fa fa-calendar text-blue-600 text-base"></i>
                    <span class="text-gray-700">
                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }}
                        — {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('H:i') }} WIB
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <i class="fa fa-location-dot text-red-600 text-base"></i>
                    <span class="text-gray-700">{{ $kegiatan->lokasi }}</span>
                </div>

                <div class="flex items-center gap-3">
                    <i class="fa fa-users text-green-600 text-base"></i>
                    <span class="text-gray-700">
                        {{ $jumlahPeserta }} / {{ $kegiatan->kuota }} peserta
                    </span>
                </div>

            </div>

            <!-- PROGRESS BAR -->
            @php
                $persen = $kegiatan->kuota > 0 ? ($jumlahPeserta / $kegiatan->kuota) * 100 : 0;
            @endphp

            <div class="mt-6">
                <div class="w-full h-2 bg-gray-200 rounded-full">
                    <div 
                        class="h-full bg-blue-600 rounded-full transition-all"
                        style="width: {{ $persen }}%">
                    </div>
                </div>
            </div>

            <!-- BUTTON DAFTAR -->
            <div class="mt-8 text-center">
                <form action="{{ route('user.kegiatan.daftar', $kegiatan->id) }}" method="POST">
                    @csrf
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 shadow">
                        Daftar Kegiatan
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

@endsection
