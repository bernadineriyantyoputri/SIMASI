@extends('layouts.app') {{-- layout admin --}}

@section('content')
    <div class="pt-4 max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Manajemen Absensi Kegiatan</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white border rounded-xl shadow-sm overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr class="text-left">
                        <th class="px-4 py-2">Kegiatan</th>
                        <th class="px-4 py-2">Peserta</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Jam Hadir</th>
                        <th class="px-4 py-2">Bukti Foto</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($absensi as $row)
                        <tr class="border-t">
                            <td class="px-4 py-2">
                                {{ $row->kegiatan->judul ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $row->user->name ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $row->tanggal ? \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') : '-' }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $row->jam_hadir ?? '-' }}
                            </td>
                            <td class="px-4 py-2">
                                @if ($row->bukti_foto)
                                    <a href="{{ asset('storage/' . $row->bukti_foto) }}"
                                       target="_blank"
                                       class="text-blue-600 underline">
                                        Lihat Foto
                                    </a>
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
                            <td class="px-4 py-2 space-x-1">
                                @if ($row->approval_status === 'pending')
                                    {{-- APPROVE --}}
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

                                    {{-- REJECT --}}
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
                                @else
                                    <span class="text-xs text-gray-400">
                                        Tidak ada aksi (status sudah {{ $row->approval_status }})
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">
                                Belum ada absensi yang dikirim.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
