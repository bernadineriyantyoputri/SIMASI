@extends('layouts.app')

@section('content')

<div class="p-6 bg-white rounded-xl shadow">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">
            Daftar Peserta — {{ $kegiatan->judul }}
        </h2>

        <a href="{{ route('admin.kegiatan.index') }}" 
           class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow">
            ← Kembali
        </a>
    </div>

    <table class="w-full border mt-4 text-left">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-3 border">No</th>
                <th class="p-3 border">Nama</th>
                <th class="p-3 border">NPM</th>
                <th class="p-3 border">Email</th>
                <th class="p-3 border">Tanggal Daftar</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($peserta as $index => $p)
            <tr>
                <td class="p-3 border">{{ $index + 1 }}</td>
                <td class="p-3 border">{{ $p->user->name }}</td>
                <td class="p-3 border">{{ $p->user->npm ?? '-' }}</td>
                <td class="p-3 border">{{ $p->user->email }}</td>
                <td class="p-3 border">{{ $p->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center p-3 text-gray-500">
                Belum ada peserta yang mendaftar
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
