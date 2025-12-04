@extends('layouts.app')

@section('content')
<div class="pt-2 max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-1">Peserta Kegiatan</h1>
    <p class="text-gray-600 mb-4">{{ $kegiatan->judul }}</p>

    @if (session('success'))
        <div class="mb-4 px-4 py-2 rounded bg-green-100 text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-xl overflow-hidden border">
        <table class="w-full border-collapse text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b text-left">Nama</th>
                    <th class="px-4 py-2 border-b text-left">NPM</th>
                    <th class="px-4 py-2 border-b text-left">Email</th>
                    <th class="px-4 py-2 border-b text-left">Status</th>
                    <th class="px-4 py-2 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peserta as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $item->user->name ?? '-' }}</td>
                        <td class="px-4 py-2 border-b">{{ $item->user->npm ?? '-' }}</td>
                        <td class="px-4 py-2 border-b">{{ $item->user->email ?? '-' }}</td>
                        <td class="px-4 py-2 border-b">
                            @if ($item->status === 'approved')
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                    Disetujui
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                    Menunggu
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border-b text-center">
                            @if ($item->status === 'pending')
                                <form action="{{ route('admin.kegiatan.peserta.approve', [$kegiatan->id, $item->id]) }}"
                                      method="POST"
                                      class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button class="px-3 py-1 text-xs rounded bg-blue-600 text-white hover:bg-blue-700">
                                        Setujui
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                            Belum ada peserta yang mendaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
