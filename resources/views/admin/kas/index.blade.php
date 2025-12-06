@extends('layouts.app')

@section('content')
<div class="pt-2 max-w-6xl mx-auto">

    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold">Manajemen Kas</h1>
            <p class="text-gray-600 text-sm">Kelola pemasukan, pengeluaran, dan saldo kas.</p>
        </div>

        <a href="{{ route('admin.kas.create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700">
            + Tambah Kas
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row gap-4 mb-6">
        <div class="flex-1 bg-green-100 rounded-xl p-6 text-center">
            <h2 class="text-lg font-semibold text-green-700 mb-2">Total Pemasukan</h2>
            <p class="text-xl font-bold text-green-800">
                Rp {{ number_format($total_pemasukan, 0, ',', '.') }}
            </p>
        </div>

        <div class="flex-1 bg-red-100 rounded-xl p-6 text-center">
            <h2 class="text-lg font-semibold text-red-700 mb-2">Total Pengeluaran</h2>
            <p class="text-xl font-bold text-red-800">
                Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}
            </p>
        </div>

        <div class="flex-1 bg-blue-100 rounded-xl p-6 text-center">
            <h2 class="text-lg font-semibold text-blue-700 mb-2">Saldo</h2>
            <p class="text-xl font-bold text-blue-800">
                Rp {{ number_format($saldo, 0, ',', '.') }}
            </p>
        </div>
    </div>

    <div class="bg-white shadow rounded-xl overflow-hidden border border-gray-200">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left text-xs md:text-sm">
                    <th class="px-4 py-3 border-b">Tanggal</th>
                    <th class="px-4 py-3 border-b">Jenis</th>
                    <th class="px-4 py-3 border-b">Nominal</th>
                    <th class="px-4 py-3 border-b">Keterangan</th>
                    <th class="px-4 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kas as $item)
                    <tr class="text-xs md:text-sm hover:bg-gray-50">
                        <td class="px-4 py-3 border-b">{{ date('d M Y', strtotime($item->tanggal)) }}</td>
                        <td class="px-4 py-3 border-b">
                            <span class="px-2 py-1 text-xs rounded
                                {{ $item->jenis === 'pemasukan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($item->jenis) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 border-b font-semibold">
                            Rp {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 border-b">{{ $item->keterangan ?? '-' }}</td>
                        <td class="px-4 py-3 border-b">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.kas.edit', $item->id) }}"
                                   class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs">
                                    Edit
                                </a>
                                <form action="{{ route('admin.kas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data kas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500 text-sm">
                            Belum ada data kas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
