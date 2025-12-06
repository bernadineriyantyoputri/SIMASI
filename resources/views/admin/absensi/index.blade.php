@extends('layouts.app') {{-- layout admin --}}

@section('content')
<div class="pt-4 max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold">Manajemen Absensi Kegiatan</h1>
            <p class="text-gray-600 text-sm">Catat dan kelola kehadiran peserta setiap kegiatan.</p>
        </div>
    </div>

    {{-- FLASH MESSAGE --}}
    @if (session('success'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 text-red-800 text-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- TABLE WRAPPER --}}
    <div class="bg-white shadow rounded-xl overflow-x-auto border border-gray-200">
        <table class="min-w-full text-sm border-collapse">
            <thead class="bg-gray-100">
                <tr class="text-left text-xs md:text-sm">
                    <th class="px-4 py-2 border-b">Kegiatan</th>
                    <th class="px-4 py-2 border-b">Peserta</th>
                    <th class="px-4 py-2 border-b">Tanggal</th>
                    <th class="px-4 py-2 border-b">Jam Hadir</th>
                    <th class="px-4 py-2 border-b">Bukti Foto</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($absensi as $row)
                    <tr class="hover:bg-gray-50 text-xs md:text-sm border-t">
                        <td class="px-4 py-2">{{ $row->kegiatan->judul ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $row->user->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $row->tanggal ? \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') : '-' }}</td>
                        <td class="px-4 py-2">{{ $row->jam_hadir ?? '-' }}</td>
                        <td class="px-4 py-2">
                            @if ($row->bukti_foto)
                                <a href="{{ asset('storage/' . $row->bukti_foto) }}"
                                   target="_blank"
                                   class="text-blue-600 underline">Lihat Foto</a>
                            @else
                                <span class="text-gray-400 text-xs">Belum ada</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <span class="px-3 py-1 rounded-full text-xs
                                @if ($row->approval_status === 'approved') bg-green-100 text-green-800
                                @elseif ($row->approval_status === 'rejected') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($row->approval_status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            @if ($row->approval_status === 'pending')
                                <div class="flex justify-center gap-2">
                                    <form action="{{ route('admin.absensi.update', $row->id) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="aksi" value="approve">
                                        <button type="submit"
                                                class="px-3 py-1 text-xs rounded bg-green-600 text-white">
                                            Setujui
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.absensi.update', $row->id) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="aksi" value="reject">
                                        <button type="submit"
                                                class="px-3 py-1 text-xs rounded bg-red-600 text-white">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-xs text-gray-400">
                                    Tidak ada aksi (status sudah {{ $row->approval_status }})
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500 text-sm">
                            Belum ada absensi yang dikirim.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
