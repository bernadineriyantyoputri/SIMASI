@extends('layouts.app')

@section('content')

<div class="pt-2">
    <!-- Judul Halaman -->
    <h1 class="text-2xl font-bold mb-6">Tambah Kegiatan</h1>

    <!-- Card Form -->
    <div class="bg-white shadow-md rounded-lg p-6 border">

        <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Kegiatan -->
            <div class="mb-4">
                <label class="block font-semibold mb-1">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan"
                class="w-full border-gray-300 rounded-lg shadow-sm p-2"
                placeholder="Masukkan nama kegiatan">
            </div>

            <!-- Tanggal Kegiatan -->
            <div class="mb-4">
                <label class="block font-semibold mb-1">Tanggal Kegiatan</label>
                <input type="date" name="tanggal"
                       class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-300">
            </div>

            <!-- Lokasi -->
            <div class="mb-4">
                <label class="block font-semibold mb-1">Lokasi</label>
                <input type="text" name="lokasi"
                       class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-300"
                       placeholder="Masukkan lokasi kegiatan">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Kuota Peserta</label>
                <input type="number" name="kuota" class="w-full ..."
                placeholder="Masukkan kuota, contoh: 50" required>
            </div>

            <!-- Upload Gambar -->
            <div class="mb-4">
                <label class="block font-semibold mb-1">Poster / Foto Kegiatan</label>
                <input type="file" name="gambar"
                       class="w-full border-gray-300 rounded-lg p-2 bg-gray-50">
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-300"
                    placeholder="Masukkan deskripsi kegiatan"></textarea>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.kegiatan.index') }}"
                   class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                    Batal
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                    Simpan Kegiatan
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
