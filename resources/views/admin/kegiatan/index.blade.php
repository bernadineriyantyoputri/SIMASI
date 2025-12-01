@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Manajemen Kegiatan</h1>

    <a href="{{ route('admin.kegiatan.create') }}"
       class="bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-800">
        + Tambah Kegiatan
    </a>
</div>

<p class="text-gray-600 mb-6">Kelola jadwal dan detail kegiatan UKM</p>

<!-- GRID CARD -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach($kegiatan as $item)
    <div class="bg-white shadow-sm border rounded-xl p-6">

        <!-- IMAGE -->
        @if($item->gambar)
        <img 
            src="{{ asset('storage/' . $item->gambar) }}" 
            alt="Gambar Kegiatan"
            class="w-full h-40 object-cover rounded-lg mb-4"
            >
        @else
            <img 
                src="{{ asset('images/no-image.jpg') }}" 
                alt="No Image"
                class="w-full h-40 object-cover rounded-lg mb-4"
            >
        @endif

        <!-- TITLE -->
        <h2 class="text-xl font-bold mt-2">{{ $item->judul }}</h2>
        <p class="text-gray-600 mt-1">{{ $item->deskripsi }}</p>

        <!-- INFO -->
        <div class="mt-4 space-y-2 text-sm text-gray-700">
            <div class="flex items-center gap-2">
                <i class="fa fa-calendar"></i>
                <span>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</span>
            </div>

            <div class="flex items-center gap-2">
                <i class="fa fa-location-dot"></i>
                <span>{{ $item->lokasi ?? '-' }}</span>
            </div>

            <div class="flex items-center gap-2">
                <i class="fa fa-users"></i>
                <span>{{ $item->jumlah_peserta ?? '0' }} peserta</span>
            </div>
        </div>

        <!-- PROGRESS BAR -->
        <div class="mt-4">
            <div class="w-full h-2 bg-gray-200 rounded-full">
                <div class="h-2 bg-blue-600 rounded-full" style="width: 70%;"></div>
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="flex justify-between mt-5">
            <a href="{{ route('admin.kegiatan.edit', $item->id) }}"
               class="px-4 py-2 rounded-lg border hover:bg-gray-100">
                Edit
            </a>

            <form action="{{ route('admin.kegiatan.destroy', $item->id) }}"
                  method="POST"
                  onsubmit="return confirm('Hapus kegiatan ini?')">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600">
                    Hapus
                </button>
            </form>
        </div>

    </div>
    @endforeach

</div>

@endsection
