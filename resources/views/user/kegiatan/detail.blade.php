@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto py-6 px-4">

    <a href="{{ route('user.kegiatan.index') }}"
       class="text-gray-600 hover:underline mb-4 inline-block text-sm">
        ← Kembali
    </a>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border">

        {{-- Gambar --}}
        <div class="w-full h-64 md:h-80 overflow-hidden">
            <img 
                src="{{ $kegiatan->gambar ? asset('storage/' . $kegiatan->gambar) : asset('images/no-image.jpg') }}"
                alt="{{ $kegiatan->judul }}"
                class="w-full h-full object-cover"
            >
        </div>

        @php
            // Hitung jumlah peserta yang SUDAH DISETUJUI (relasi sudah di-filter di model)
            $jumlahPeserta = $kegiatan->peserta()->count();

            $persen = $kegiatan->kuota > 0 
                ? ($jumlahPeserta / $kegiatan->kuota) * 100 
                : 0;

            // status pendaftaran user saat ini (null / pending / approved)
            $status = $peserta->status ?? null;
        @endphp

        <div class="p-6">

            {{-- Flash message --}}
            @if (session('success'))
                <div class="mb-4 px-4 py-2 rounded bg-green-100 text-green-800 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 px-4 py-2 rounded bg-red-100 text-red-800 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Judul -->
            <h2 class="font-bold text-3xl text-gray-800 mb-3">
                {{ $kegiatan->judul }}
            </h2>

            <p class="text-gray-600 leading-relaxed mb-6">
                {{ $kegiatan->deskripsi }}
            </p>

            <div class="space-y-4 text-sm">

                <div class="flex items-center gap-3">
                    <i class="fa-regular fa-calendar text-base"></i>
                    <span class="text-gray-700">
                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }}
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <i class="fa-regular fa-clock text-base"></i>
                    <span class="text-gray-700">
                        {{ $kegiatan->jam ? \Carbon\Carbon::parse($kegiatan->jam)->format('H:i') : '-' }} WIB
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-location-dot text-base"></i>
                    <span class="text-gray-700">{{ $kegiatan->lokasi }}</span>
                </div>

                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-users text-base"></i>
                    <span class="text-gray-700">
                        {{ $jumlahPeserta }} / {{ $kegiatan->kuota }} peserta
                    </span>
                </div>

            </div>

            {{-- Progress bar kuota --}}
            <div class="mt-6">
                <div class="w-full h-2 bg-gray-200 rounded-full">
                    <div 
                        class="h-full bg-blue-600 rounded-full transition-all"
                        style="width: {{ $persen }}%">
                    </div>
                </div>
            </div>

            {{-- Tombol / status --}}
            <div class="mt-8 text-center">

                @if (is_null($status))
                    {{-- Belum daftar --}}
                    @if ($jumlahPeserta >= $kegiatan->kuota)
                        <button 
                            class="px-6 py-2 bg-gray-400 text-white font-semibold rounded-lg cursor-not-allowed shadow">
                            Kuota Penuh
                        </button>
                    @else
                        <form action="{{ route('user.kegiatan.daftar', $kegiatan->id) }}" method="POST">
                            @csrf
                            <button 
                                type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 shadow">
                                Daftar Kegiatan
                            </button>
                        </form>
                    @endif

                @elseif ($status === 'pending')
                    {{-- Sudah daftar, menunggu persetujuan --}}
                    <div class="mb-3 px-4 py-2 inline-block rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">
                        Menunggu persetujuan admin
                    </div>

                    <form action="{{ route('user.kegiatan.batal', $kegiatan->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="mt-1 px-6 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 shadow">
                            Batalkan Pendaftaran
                        </button>
                    </form>

                @elseif ($status === 'approved')
                    {{-- Sudah disetujui --}}
                    <div class="mb-3 px-4 py-2 inline-block rounded-full bg-green-100 text-green-800 text-xs font-semibold">
                        Kamu sudah terdaftar sebagai peserta
                    </div>

                    <form action="{{ route('user.kegiatan.batal', $kegiatan->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="mt-1 px-6 py-2 border border-red-400 text-red-600 font-semibold rounded-lg hover:bg-red-50 shadow">
                            Batalkan Keikutsertaan
                        </button>
                    </form>
                @endif

            </div>

        </div>

    </div>

</div>

@endsection
