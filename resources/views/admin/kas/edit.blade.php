@extends('layouts.app')

@section('content')
<div class="pt-2 px-6">

    <h1 class="text-2xl font-bold mb-6">Edit Kas</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6 border w-full md:w-1/2">

        <form action="{{ route('admin.kas.update', $kas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Tanggal</label>
                <input type="date" name="tanggal"
                       value="{{ old('tanggal', $kas->tanggal) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-300"
                       required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Jenis Transaksi</label>
                <select name="jenis"
                        class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-300"
                        required>
                    <option value="pemasukan" {{ old('jenis', $kas->jenis) == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="pengeluaran" {{ old('jenis', $kas->jenis) == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Kategori</label>
                <input type="text" name="kategori"
                       value="{{ old('kategori', $kas->kategori) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-300"
                       placeholder="Contoh: Iuran, Konsumsi, Transport"
                       required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Nominal (Rp)</label>
                <input type="number" name="nominal"
                       value="{{ old('nominal', $kas->nominal) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-300"
                       placeholder="Masukkan nominal"
                       required>
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-1">Keterangan</label>
                <textarea name="keterangan" rows="4"
                          class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-300"
                          placeholder="Masukkan keterangan transaksi"
                          required>{{ old('keterangan', $kas->keterangan) }}</textarea>
            </div>

            <div class="flex justify-start gap-3">
                <a href="{{ route('admin.kas.index') }}"
                   class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                    Batal
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                    Update Kas
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
