@extends('layouts.app')

@section('content')

<div class="px-4 md:px-8 py-6">

    <h1 class="text-2xl font-bold mb-1">Daftar Kegiatan</h1>
    <p class="text-gray-600 mb-6">Pilih kegiatan yang ingin kamu ikuti</p>

    <!-- Kontainer di tengah seperti admin -->
    <div class="w-full">

        <!-- Grid card kecil (2 kolom) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($kegiatan as $k)
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm">

                <div class="h-32 w-full overflow-hidden rounded-t-xl">
                    <img src="{{ $k->gambar ? asset('storage/'.$k->gambar) : asset('images/no-image.jpg') }}"
                        class="w-full h-full object-cover" />
                </div>

                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <h2 class="text-sm font-semibold text-gray-800 line-clamp-1">
                            {{ $k->judul }}
                        </h2>
                    </div>

                    <p class="text-xs text-gray-600 mt-2 line-clamp-2">
                        {{ $k->deskripsi }}
                    </p>

                    <div class="mt-3 space-y-1 text-[11px] text-gray-500">
                        <div class="flex gap-1 items-center">
                            <i class="fa-regular fa-calendar text-[10px]"></i>
                            {{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('l, d F Y') }}
                        </div>

                        <div class="flex gap-1 items-center">
                            <i class="fa-solid fa-location-dot text-[10px]"></i>
                            {{ $k->lokasi }}
                        </div>

                        <div class="flex gap-1 items-center">
                            <i class="fa-solid fa-users text-[10px]"></i>
                            {{ $k->peserta_count }} / {{ $k->kuota }} peserta
                        </div>
                    </div>

                    <a href="{{ route('user.kegiatan.detail', $k->id) }}"
                        class="mt-4 block w-full text-center text-xs py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                        Lihat Detail
                    </a>
                </div>

            </div>
            @endforeach

        </div>

    </div>

</div>

@endsection
