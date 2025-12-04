@extends('layouts.app')

@section('content')

<div class="pt-2">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Manajemen Kegiatan</h1>

        <a href="{{ route('admin.kegiatan.create') }}"
           class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
            + Tambah Kegiatan
        </a>
    </div>

    <p class="text-gray-600 mb-6">Kelola jadwal dan detail kegiatan UKM</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($kegiatan as $item)
        <div class="bg-white border shadow-sm rounded-xl p-5">

            <img
                src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/no-image.jpg') }}"
                class="w-full h-60 object-cover rounded-lg mb-4"
            >

            <h2 class="text-xl font-bold">{{ $item->judul }}</h2>
            <p class="text-gray-600 mt-1">{{ $item->deskripsi }}</p>

            <div class="mt-4 space-y-2 text-sm text-gray-700">

                <div class="flex items-center gap-2">
                    <i class="fa fa-calendar"></i>
                    <span>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</span>
                </div>

                <div class="flex items-center gap-2">
                    <i class="fa fa-clock"></i>
                    <span>
                        {{ $item->jam ? \Carbon\Carbon::parse($item->jam)->format('H:i') : '-' }} WIB
                    </span>
                </div>

                <div class="flex items-center gap-2">
                    <i class="fa fa-location-dot"></i>
                    <span>{{ $item->lokasi ?? '-' }}</span>
                </div>

                <div class="flex items-center gap-2">
                    <i class="fa fa-users"></i>
                    <span>{{ $item->peserta_count }} / {{ $item->kuota }} peserta</span>
                </div>
            </div>

            @php
                $persen = $item->kuota > 0 ? ($item->peserta_count / $item->kuota) * 100 : 0;
            @endphp

            <div class="mt-4">
                <div class="h-2 bg-gray-200 rounded-full">
                    <div class="h-2 bg-blue-600 rounded-full" style="width: {{ $persen }}%"></div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-5">

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.kegiatan.edit', $item->id) }}"
                       class="px-3 py-2 border rounded-lg hover:bg-gray-100 text-sm">
                        Edit
                    </a>

                    <a href="{{ route('admin.kegiatan.peserta', $item->id) }}"
                       class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 text-sm">
                        Peserta
                    </a>
                </div>

                <form action="{{ route('admin.kegiatan.destroy', $item->id) }}"
                      method="POST"
                      onsubmit="return confirm('Hapus kegiatan ini?')">
                    @csrf
                    @method('DELETE')

                    <button
                        class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 text-sm">
                        Hapus
                    </button>
                </form>

            </div>

        </div>
        @endforeach

    </div>
</div>

@endsection
