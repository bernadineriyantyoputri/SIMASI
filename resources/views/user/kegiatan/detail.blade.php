@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/kegiatan.css') }}">

<div class="max-w-4xl mx-auto py-6 px-4">

    <a href="{{ route('user.kegiatan.index') }}" 
       class="text-gray-600 hover:underline mb-4 inline-block text-sm">
        ← Kembali
    </a>

    <!-- CARD UTAMA -->
    <div class="card-kegiatan">

        <!-- Bagian Gambar -->
        <div class="card-img-wrapper">
            <img 
                src="{{ $kegiatan->gambar ? asset('storage/' . $kegiatan->gambar) : asset('images/no-image.jpg') }}"
                alt="{{ $kegiatan->judul }}"
                class="card-kegiatan-img"
            >
        </div>

        <!-- Bagian Isi -->
        <div class="card-kegiatan-body">

            <h2 class="font-semibold text-3xl mb-3 text-gray-800">
                {{ $kegiatan->judul }}
            </h2>

            <p class="text-gray-600 leading-relaxed mb-6">
                {{ $kegiatan->deskripsi }}
            </p>

            <div class="space-y-4 text-sm text-gray-700">

                <div class="flex items-center gap-3">
                    <i class="fa fa-calendar text-blue-600 text-lg"></i>
                    <span>
                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }}
                        · {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('H:i') }} WIB
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <i class="fa fa-location-dot text-red-600 text-lg"></i>
                    <span>{{ $kegiatan->lokasi }}</span>
                </div>

                <div class="flex items-center gap-3">
                    <i class="fa fa-users text-green-600 text-lg"></i>
                    <span>{{ $jumlahPeserta }} / {{ $kegiatan->kuota }} peserta terdaftar</span>
                </div>
            </div>

            @php
                $persen = $kegiatan->kuota > 0 
                    ? ($jumlahPeserta / $kegiatan->kuota) * 100 
                    : 0;
            @endphp

            <div class="mt-6">
                <div class="w-full bg-gray-200 h-2 rounded-full">
                    <div 
                        class="h-full bg-blue-600 rounded-full"
                        style="width: {{ $persen }}%">
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
    <form action="{{ route('user.kegiatan.daftar', $kegiatan->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-daftar">
            Daftar Kegiatan
        </button>
    </form>
</div>

        </div>

    </div>

</div>
@endsection
