@extends('layouts.app')

@section('content')
<div class="px-6 py-6">

    <h1 class="text-2xl font-bold mb-6">Edit Kegiatan</h1>

    <div class="bg-white shadow-md rounded-lg p-6 border">

        <form action="{{ route('admin.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan"
                       value="{{ old('nama_kegiatan', $kegiatan->judul) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-300">
            </div>


            <div class="mb-4">
                <label class="block font-semibold mb-1">Tanggal</label>
                <input type="date" name="tanggal"
                       value="{{ old('tanggal', $kegiatan->tanggal) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-300">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Jam Kegiatan</label>
                <input type="time" name="jam"
                       value="{{ old('jam', $kegiatan->jam ?? '') }}"
                       class="w-full p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Lokasi</label>
                <input type="text" name="lokasi"
                       value="{{ old('lokasi', $kegiatan->lokasi) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-300">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Kuota Peserta</label>
                <input type="number" name="kuota"
                       value="{{ old('kuota', $kegiatan->kuota) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-300">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Poster / Foto Kegiatan</label>

                @if($kegiatan->gambar)
                    <p class="text-sm mb-2">Gambar Saat Ini:</p>
                    <img src="{{ asset('storage/' . $kegiatan->gambar) }}"
                         class="w-40 rounded-lg mb-3 border">
                @endif

                <input type="file" name="gambar"
                       class="w-full border-gray-300 rounded-lg p-2 bg-gray-50">
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-300">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.kegiatan.index') }}"
                   class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                    Batal
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                    Update Kegiatan
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
